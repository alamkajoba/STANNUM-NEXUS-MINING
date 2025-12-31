<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Deduction;
use App\Models\Advance;
use App\Models\AdvanceRepayment;
use App\Models\Category;
use App\Enums\MonthEnum;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Enums\RelationTypeEnum;
use Carbon\Carbon;


#[Layout('layouts.app')]
class PaymentCreate extends Component
{

    //Validate
    #[Validate('required')]
    public $employee_id = '';
    #[Validate('required')]
    public $motif = '';
    #[Validate('nullable')]
    public $restDay = 0;
    #[Validate('nullable')]
    public $justifyDay = 0;
    #[Validate('nullable')]
    public $overtimes = 0.00; 
    #[Validate('nullable')]
    public $assudityBonus = 0.00; 
    #[Validate('nullable')]
    public $riskBonus = 0.00; 
    #[Validate('nullable')]
    public $performanceBonus = 0.00; 

    //Var for auto complete employee
    public $search = '';
    public $itemsEmployee = [];
    public $selectedEmployee = [null];

    //All for paySlip
    public $childCount = 0;
    public $restDayCost = 0.00;
    public $dayPay = 0.00;
    public $baseSalary = 0.00;
    public $dayMounth = 0;
    public $justifyDayPay = 0.00;
    public $workDay = 0;
    //payment
    public $baseMounthlyDay = 0.00;
    public $overtimesPay = 0.00;
    public $totalDue = 0.00;
    //advantage
    public $housingDay = 0.00;
    public $housingMounth = 0.00;
    public $transportationCostDay = 0.00;
    public $transportationCostMounth = 0.00;
    public $familialAllocationDay = 0.00;
    public $familialAllocationMounth = 0.00;
    public $totalAdvantage= 0.00;
    //advance
    public $remainToPay = 0.00;
    public $remainAfterDeduction = 0.00;
    public $amountToDeduct = 0.00;
    public $applyAdvance = true;
    public $appliedAdvanceDeduction = 0.00;
    //deduction
    public $CNSS = 0.00;
    public $INPP = 0.00;
    public $ONEM = 0.00;
    public $IPR = 0.00;
    public $deductionSalary = 0.00;
    public $refund = 0.00;
    public $CNSSAmount = 0.00;
    public $INPPAmount = 0.00;
    public $ONEMAmount = 0.00;
    public $IPRAmount = 0.00;
    public $deductionSalaryAmount = 0.00;
    public $refundAmount = 0.00;
    public $totalDeduction = 0.00;
    //final
    public $brutSalary = 0.00;
    public $netSalary = 0.00;



    public function searchEmployee(): void
    {
        //Looking for items
        $this->itemsEmployee = Employee::where('firstName', 'like', '%'.$this->search.'%')
            ->orwhere('lastName', 'like', '%'.$this->search.'%')
            ->orwhere('middleName', 'like', '%'.$this->search.'%')
            ->orwhere('matricule', 'like', '%'.$this->search.'%')
            ->limit(3)
            ->get()
            ->toArray();
    }

    //Selected Employee
    public function selectEmployee($itemId): void
    {
        // Sélectionne un élément
        $this->selectedEmployee = Employee::find($itemId)->toArray();
        $this->search = $this->selectedEmployee['middleName'].' '.$this->selectedEmployee['lastName'].' '.$this->selectedEmployee['firstName'];
        $this->employee_id = $this->selectedEmployee['id'];
        $this->category_id = $this->selectedEmployee['category_id'];
        $this->itemsEmployee = []; // Vide les suggestions

        // Load any active advance for the selected employee and set remaining to display
        $advance = Advance::where('employee_id', $this->employee_id)
                          ->where('toRefund', '>', 0)
                          ->first();

        $this->remainToPay = $advance->toRefund ?? 0.00;

        // Load current deduction percentage (default to 20% if none configured)
        $deduction = Deduction::latest()->first();
        $refundPercentage = $deduction->refundAdvanceAmount ?? 20;
        $this->refund = $refundPercentage;

        // Estimate refundAmount using employee category base salary for preview
        $baseSalary = $this->selectedEmployee['category_id'] ? Employee::find($this->employee_id)?->category?->amount : 0;
        $this->refundAmount = round(($baseSalary * $refundPercentage) / 100, 2);

        // Compute estimated deduction capped by remaining advance
        $this->amountToDeduct = min($this->refundAmount, $this->remainToPay);
        $this->appliedAdvanceDeduction = $this->applyAdvance ? $this->amountToDeduct : 0.00;
        $this->remainAfterDeduction = round(($this->remainToPay - $this->appliedAdvanceDeduction), 2);

        // Reset computed advance-related fields for clarity if no advance
        if (!$advance) {
            $this->amountToDeduct = 0.00;
            $this->refundAmount = 0.00;
            $this->appliedAdvanceDeduction = 0.00;
            $this->remainAfterDeduction = 0.00;
        }
    }

    public function submitPayment()
    {
        $motif = Carbon::parse($this->motif);

        $existPayment = Payment::where('employee_id', $this->employee_id)
            ->where('motif', $motif)
            ->exists();

        if ($existPayment) {
            session()->flash('danger', "Cet Agent a déjà reçu ce paiement verifiez la liste!...");
            return redirect()->route('payment.index');
        }

        $deduction = Deduction::latest()->first();

        $employee = Employee::with([
            'category',
            'familyState' => function($query) {
                $query->where('relationType', RelationTypeEnum::CHILD->value);
            }
        ])->findOrFail($this->employee_id);

        $advance = Advance::where('employee_id', $this->employee_id)
                  ->where('toRefund', '>', 0)
                  ->first();

        $this->baseSalary = $employee->category->amount;
        $this->childCount = $employee->familyState->count();
        $this->dayMounth = $employee->category->workDay;
        $this->workDay = round($employee->category->workDay - $this->restDay, 2);
        $this->baseMounthlyDay = round($this->baseSalary / max(1, $this->dayMounth), 2);
        $this->dayPay = round($this->baseSalary / max(1, $this->dayMounth), 2);
        $this->overtimesPay = round($this->overtimes * $employee->category->hourAmount, 2);

        if($this->restDay > 0)
        {
            $this->restDayCost = round($this->dayPay * $this->restDay, 2);
        }
        if($this->justifyDay > 0)
        {
            $this->justifyDayPay = round($this->dayPay * $this->justifyDay, 2);
        }
        

        
        $this->housingMounth = $employee->category->housing;
        $this->housingDay = round($this->housingMounth / max(1, $this->dayMounth), 2);
        $this->transportationCostMounth = $employee->category->transportationCost;
        $this->transportationCostDay = round($this->transportationCostMounth / max(1, $this->dayMounth), 2);
        $this->familialAllocationMounth = round($employee->category->familialAllocation * $this->childCount, 2);
        $this->familialAllocationDay = round($this->familialAllocationMounth / max(1, $this->dayMounth), 2);
        
        $this->totalDue = ($this->baseSalary + $this->overtimesPay + $this->assudityBonus + $this->riskBonus + $this->performanceBonus + $this->justifyDayPay) - $this->restDayCost;
       
        $this->totalAdvantage = round($this->housingMounth + $this->transportationCostMounth + $this->familialAllocationMounth, 2);
        
        $this->brutSalary = round($this->totalAdvantage + $this->totalDue, 2);

        $this->CNSS = $deduction->CNSS ?? 0;
        $this->INPP = $deduction->INPP ?? 0;
        $this->IPR = $deduction->IPR ?? 0;
        $this->ONEM = $deduction->ONEM ?? 0;
        // Use configured refund percentage or default to 20%
        $this->refund = $deduction->refundAdvanceAmount ?? 20; // percentage
        $this->deductionSalary = $deduction->deductionSalary ?? 0;

        $this->CNSSAmount = round(($this->brutSalary * $this->CNSS) / 100, 2);
        $this->INPPAmount = round(($this->brutSalary * $this->INPP) / 100, 2);
        $this->IPRAmount  = round(($this->brutSalary * $this->IPR) / 100, 2);
        $this->ONEMAmount = round(($this->brutSalary * $this->ONEM) / 100, 2);

        // Theoretical refund amount based on the configured percentage
        $this->refundAmount = round(($this->brutSalary * $this->refund) / 100, 2);

        // Compute actual deduction capped by remaining advance
        if ($advance) {
            $this->amountToDeduct = min($this->refundAmount, $advance->toRefund);
        } else {
            $this->amountToDeduct = 0;
        }

        // If user chose not to apply advance refund, zero the applied deduction
        $this->appliedAdvanceDeduction = $this->applyAdvance ? $this->amountToDeduct : 0;

        $this->totalDeduction = round($this->CNSSAmount 
                                + $this->INPPAmount 
                                + $this->IPRAmount 
                                + $this->ONEMAmount 
                                + $this->appliedAdvanceDeduction, 2);

        $this->netSalary = round($this->brutSalary - $this->totalDeduction, 2);

        // Debug log to help trace advance refund calculations
        logger()->info('Payment debug', [
            'employee_id' => $this->employee_id,
            'refundPercentage' => $this->refund,
            'refundAmount_theoretical' => $this->refundAmount,
            'amountToDeduct' => $this->amountToDeduct,
            'appliedAdvanceDeduction' => $this->appliedAdvanceDeduction,
            'applyAdvance' => $this->applyAdvance,
            'hasAdvance' => (bool)$advance,
            'advance_toRefund' => $advance->toRefund ?? null,
            'brutSalary' => $this->brutSalary,
            'netSalary' => $this->netSalary,
        ]);

        $id = Auth::id();
        $payment = Payment::create([
            'employee_id' => $this->employee_id, 
            'motif' => $motif, 
            'user_id' => $id,
            //All for paySlip
            'childCount' => $this->childCount,
            'baseSalary' => $this->baseSalary,
            'dayMounth' => $this->dayMounth,
            'justifyDay' => $this->justifyDay,
            'workDay' => $this->workDay,
            //payment
            'baseMounthlyDay' => $this->baseMounthlyDay,
            'overtimesPay' => $this->overtimesPay,
            //advantage
            'housingDay' => $this->housingDay,
            'housingMounth' => $this->housingMounth,
            'transportationCostDay' => $this->transportationCostDay,
            'transportationCostMounth' => $this->transportationCostMounth,
            'familialAllocationDay' => $this->familialAllocationDay,
            'familialAllocationMounth' => $this->familialAllocationMounth,
            'totalAdvantage' => $this->totalAdvantage,
            //deduction
            'CNSS' => $this->CNSS,
            'INPP' => $this->INPP,
            'ONEM' => $this->ONEM,
            'IPR' => $this->IPR,
            'deductionSalary' => $this->deductionSalary,
            'refund' => $this->refund, // percentage
            'CNSSAmount' => $this->CNSSAmount,
            'INPPAmount' => $this->INPPAmount,
            'ONEMAmount' => $this->ONEMAmount,
            'IPRAmount' => $this->IPRAmount,
            'deductionSalaryAmount' => $this->deductionSalaryAmount,
            'refundAmount' => $this->appliedAdvanceDeduction, // actual deducted amount
            'totalDeduction' => $this->totalDeduction,
            //final
            'brutSalary' => $this->brutSalary,
            'netSalary' => $this->netSalary,
        ]);

        // Apply deduction to active advance and record repayment
        if ($advance && $this->appliedAdvanceDeduction > 0) {
            $advance->toRefund = round($advance->toRefund - $this->appliedAdvanceDeduction, 2);
            $advance->save();

            AdvanceRepayment::create([
                'advance_id' => $advance->id,
                'payment_id' => $payment->id,
                'amount' => $this->appliedAdvanceDeduction,
                'user_id' => $id,
                'paid_at' => now(),
            ]);

            // Update remaining after deduction for immediate feedback
            $this->remainAfterDeduction = round($advance->toRefund, 2);
        }

        session()->flash('success', "Paiement enregistré avec succès.");
        return redirect()->route('payment.index');

    }

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
 