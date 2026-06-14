<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Deduction;
use App\Models\Advance;
use App\Models\AdvanceRepayment;
use App\Models\Category;
use App\Enums\MonthEnum;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Enums\RelationTypeEnum;
use Carbon\Carbon;
use App\Models\Enrollment;
use App\Models\Attendance;
use Brick\Math\RoundingMode;
use Brick\Money\Money;


#[Layout('layouts.app')]
class PaymentCreate extends Component
{

    //Validate
    public $employee_id;
    public $enrollment_id;

    #[Validate('required')]
    public $motif = '';
    #[Validate('required|numeric|min:0')]
    public $restDay = 0;
    #[Validate('nullable|numeric|min:0')]
    public $justifyDay = 0;
    #[Validate('nullable|numeric|min:0')]
    public $overtimes = 0; 
    #[Validate('nullable|numeric|min:0|max:999999')]
    public $assudityBonus = 0.00; 
    #[Validate('nullable|numeric|min:0|max:999999')]
    public $riskBonus = 0.00; 
    #[Validate('nullable|numeric|min:0|max:999999')]
    public $performanceBonus = 0.00; 

    //Var for auto complete employee
    public $search = '';
    public $itemsEmployee = [];
    public $selectedEmployee = [null];



    public function searchEmployee(): void
        {
            if (strlen($this->search) < 1 || str_contains($this->search, ' - ')) {
                $this->itemsEmployee = [];
                return;
            }

            // 1. Catch collection with relations
            $enrollments = Enrollment::with(['employee', 'functionType'])
                ->where(function ($query) {
                    $query->where('matricule', 'like', '%' . $this->search . '%')
                    ->orWhereHas('employee', function ($q) {
                        $q->where('firstName', 'like', '%' . $this->search . '%')
                        ->orWhere('lastName', 'like', '%' . $this->search . '%')
                        ->orWhere('middleName', 'like', '%' . $this->search . '%');
                    });
                })
                ->limit(5)
                ->get();

            // 2. Simple table "Livewire-friendly"
            $this->itemsEmployee = $enrollments->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'matricule'     => $item->matricule,
                    // Security : if employee relation is True
                    'full_name'     => $item->employee 
                                        ? "{$item->employee->lastName} {$item->employee->firstName}" 
                                        : 'Employé inconnu',
                    // Security : Catch amount from Cast Money and convert to float
                    'base_salary'   => $item->functionType?->amount?->getAmount()->toFloat() ?? 0,
                    'function_name' => $item->functionType?->nameFunction ?? 'N/A',
                ];
            })->all(); // .all() ou .toArray()
        }

        //Selected Employee
    public function selectEmployee($itemId): void
    {
        // Select enrollment with his relations
        $enrollment = Enrollment::with(['employee', 'functionType'])->find($itemId);

        if ($enrollment) {
            $this->employee_id = $enrollment->employee_id; 
            $this->enrollment_id = $enrollment->id;
            
            $emp = $enrollment->employee;
            // Update search field with full name
            $this->search = "{$enrollment->matricule} - {$emp->lastName} {$emp->firstName}";
            
            // Extract amount and convert to float
            $this->selectedEmployee = [
                'id' => $enrollment->id,
                'baseSalary' => $enrollment->functionType->amount->getAmount()->toFloat(),
                'dayPay' => $enrollment->functionType->dayAmount->getAmount()->toFloat(),
                'hourPay' => $enrollment->functionType->hourAmount->getAmount()->toFloat(),
            ]; 

            // reset totals if needed
            $this->baseSalary = $this->selectedEmployee['baseSalary'];
            
            // close 
            $this->itemsEmployee = [];
        }
    }
    //Initialize to zero after update
    public function updatedrestDay($value) {
        if ($value === "" || $value === null) $this->restDay = 0;
    }

    public function updatedjustifyDay($value) {
        if ($value === "" || $value === null) $this->justifyDay = 0;
    }

    public function updatedOvertimes($value) {
        if ($value === "" || $value === null) $this->overtimes = 0;
    }

    public function updatedassudityBonus($value) {
        if ($value === "" || $value === null) $this->assudityBonus = 0.00;
    }

    public function updatedriskBonus($value) {
        if ($value === "" || $value === null) $this->riskBonus = 0.00;
    }

    public function updatedperformanceBonus($value) {
        if ($value === "" || $value === null) $this->performanceBonus = 0.00;
    }

    public function submitPayment()
    {
        if (!$this->enrollment_id) {
            session()->flash('danger', "Sélectionnez un agent !");
            return;
        }

        $motif = Carbon::parse($this->motif);
        $paymentExists = Payment::where('employee_id', $this->employee_id)
                            ->whereDate('motif', $motif)
                            ->exists();

        if ($paymentExists) {
            session()->flash('danger', "L'agent a déjà eu ce salaire vérifiez la liste");
            return;
        }

        $deduction = Deduction::latest()->first();
        if (! $deduction) {
            session()->flash('danger', "Aucune règle de déduction configurée.");
            return;
        }
        
        // 1. Catch enrollment with relations
        $enrollment = Enrollment::with([
            'employee.familyState' => function($query) {
                $query->where('relationType', RelationTypeEnum::CHILD->value);
            },

            'functionType'
        ])->where('employee_id', $this->employee_id)
        ->first();

        // 2. Initialisation des montants de base (Objets Money via le Cast du modèle)
        // On utilise optional() pour éviter les crashs si le lien est cassé
        $baseSalary = $enrollment->functionType->amount; 
        $workDay = $enrollment->functionType->workDay; 
        $dayPay     = $enrollment->functionType->dayAmount;
        $hourPay    = $enrollment->functionType->hourAmount;
        $housing    = $enrollment->functionType->housing;
        $transport  = $enrollment->functionType->transportationCost;
        $allocPerChild = $enrollment->functionType->familialAllocation;

        // 3. Calculs des gains (Addictions)
        $childCount = $enrollment->employee->familyState->count();
        
        // Heures supplémentaires
        $overtimesPay = $hourPay->multipliedBy($this->overtimes, RoundingMode::FLOOR);
        
        // Bonus (On convertit les inputs du formulaire en Money)
        $assudity    = Money::of($this->assudityBonus, 'USD');
        $risk        = Money::of($this->riskBonus, 'USD');
        $performance = Money::of($this->performanceBonus, 'USD');
        
        // Absences et Justifiés: compute from Attendance records for the month of motif
        $periodStart = $motif->copy()->startOfMonth();
        $periodEnd = $motif->copy()->endOfMonth();

        $attendanceRows = Attendance::where('employee_id', $this->employee_id)
            ->whereBetween('date', [$periodStart->format('Y-m-d'), $periodEnd->format('Y-m-d')])
            ->get();

        $absencesCount = $attendanceRows->where('status', 'absent')->count();
        $justifiedCount = $attendanceRows->where('status', 'justified')->count();
        $presentCount = $attendanceRows->where('status', 'present')->count();

        // override any manual input with computed values
        $this->restDay = $absencesCount;
        $this->justifyDay = $justifiedCount;

        $restDayCost   = $dayPay->multipliedBy($this->restDay, RoundingMode::FLOOR);
        $justifyDayPay = $dayPay->multipliedBy($this->justifyDay, RoundingMode::FLOOR);

        // 4. Calcul du Brut de Paie (Total Due)
        // Formule : (Base + Heures Supp + Bonus + Justifiés) - Absences
        $totalAddiction = ($overtimesPay)
            ->plus($assudity)
            ->plus($risk)
            ->plus($performance)
            ->plus($justifyDayPay)
            ->minus($restDayCost);

        $totalDue = $baseSalary
            ->plus($totalAddiction, RoundingMode::FLOOR);

        // 5. Avantages Sociaux
        $totalAlloc = $allocPerChild->multipliedBy($childCount, RoundingMode::FLOOR);
        $totalAdvantage = $housing->plus($transport)->plus($totalAlloc);

        // Salaire Brut Total (Base imposable)
        $brutSalary = $totalDue->plus($totalAdvantage);

        // 6. Manage deductions
        // use dividedBy(100) 
        $cnssAmount = $brutSalary->multipliedBy($deduction->CNSS, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);
        $inppAmount = $brutSalary->multipliedBy($deduction->INPP, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);
        $iprAmount  = $brutSalary->multipliedBy($deduction->IPR, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);
        $onemAmount = $brutSalary->multipliedBy($deduction->ONEM, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);
        $deducionSalaryAmount = $brutSalary->multipliedBy($deduction->deductionSalary, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);

        // 7. Manage advance
        $advance = Advance::where('employee_id', $this->employee_id)->where('toRefund', '>', 0)->first();
        $refundAmount = Money::of(0, 'USD');
        
        //CHRISDEV

        // if ($advance && $this->applyAdvance) {
        //     $theoreticalRefund = $brutSalary->multipliedBy($deduction->refundAdvanceAmount, RoundingMode::FLOOR)->dividedBy(100, RoundingMode::FLOOR);
        //     
        //     $advanceDebt = $advance->remainToPay; // Déjà un objet Money via Cast
        //     $refundAmount = $theoreticalRefund->isGreaterThan($advanceDebt) ? $advanceDebt : $theoreticalRefund;
        // }

        // 8. Final calcul
        $totalDeduction = $cnssAmount
            ->plus($inppAmount)
            ->plus($iprAmount)
            ->plus($onemAmount)
            ->plus($deducionSalaryAmount)
            ->plus($refundAmount);

        $netSalary = $brutSalary->minus($totalDeduction);

        $id = Auth::id();
        try {
            $payment = Payment::create([
                'employee_id' => $this->employee_id,
                'motif' => $motif,
                'user_id' => $id,
                'netSalary' => $netSalary,
                //JSON
                'slipPrint' => [
                    //Employee section
                    'function' => $enrollment?->functionType?->nameFunction,
                    'section' => $enrollment?->section,
                    'department' => $enrollment?->department,
                    'site' => $enrollment?->site,
                    'professionalCategory' => $enrollment?->professionalCategory,
                    'echelon' => $enrollment?->echelon,
                    'acountNumber' => $enrollment?->acountNumber,
                    'cnssNumber' => $enrollment?->cnssNumber,
                    'childCount' => $childCount,
                    'baseSalary' => $baseSalary->getAmount()->toFloat(),
                    'workDay' => $workDay,
                    //Invoice section 1 brutDue and total
                    'abscence' => $this->restDay,
                    'absencePay' => $restDayCost->getAmount()->toFloat(),
                    'justify' => $this->justifyDay,
                    'justifyPay' => $justifyDayPay->getAmount()->toFloat(),
                    'overtimes' => $this->overtimes,
                    'overtimesPay' => $overtimesPay->getAmount()->toFloat(),
                    'assuduity' => $assudity->getAmount()->toFloat(),
                    'risk' => $risk->getAmount()->toFloat(),
                    'performance' => $performance->getAmount()->toFloat(),
                    'totalAddiction' => $totalAddiction->getAmount()->toFloat(),
                    'brutDue' => $totalDue->getAmount()->toFloat(),
                    //Invoice section 2 Social advantage
                    'housing' => $housing->getAmount()->toFloat(),
                    'transportation' => $transport->getAmount()->toFloat(),
                    'familialAllocation' => $allocPerChild->getAmount()->toFloat(),
                    'totalAdvantage' => $totalAdvantage->getAmount()->toFloat(),
                    'totalDeduction' => $totalDeduction->getAmount()->toFloat(),
                    'brutSalary' => $brutSalary->getAmount()->toFloat(),
                    //Invoice section 3 Deductions
                    'CNSS' => $deduction->CNSS,
                    'ONEM' => $deduction->ONEM,
                    'INPP' => $deduction->INPP,
                    'IPR' => $deduction->IPR,
                    'toRefundAdvance' => $deduction->refundAdvanceAmount,
                    'salaryDeduction' => $deduction->deductionSalary,
                    'CNSSAmount' => $cnssAmount->getAmount()->toFloat(),
                    'ONEMAmount' => $onemAmount->getAmount()->toFloat(),
                    'INPPAmount' => $inppAmount->getAmount()->toFloat(),
                    'IPRAmount' => $iprAmount->getAmount()->toFloat(),
                    'refundAdvanceAmount' => $refundAmount->getAmount()->toFloat(),
                    'salaryDeductionAmount' => $deducionSalaryAmount->getAmount()->toFloat(),
                ],
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Payment create failed: ' . $e->getMessage(), [
                'employee_id' => $this->employee_id,
                'enrollment_id' => $this->enrollment_id,
                'motif' => (string) $motif,
            ]);
            session()->flash('danger', 'Erreur lors de la création du paiement. Vérifiez les logs.');
            return;
        }

        session()->flash('success', 'Paiement effectué avec succès !');
        return redirect()->route('payment.print', $payment->id);

    }

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
 