<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Deduction;
use App\Models\Advance;
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
    public $totalAddiction = 0.00;
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
    public $amountToDeduct = 0.00;
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

    }

    public function submitPayment()
    {
        $motif = Carbon::parse($this->motif);

        // $existPayment = Payment::where('employee_id', $this->employee_id)
        //     ->where('motif', $motif)
        //     ->exists();

        // if ($existPayment) {
        //     session()->flash('danger', "Cet Agent a déjà reçu ce paiement verifiez la liste!...");
        //     return redirect()->route('payment.index');
        // }

        $deduction = Deduction::latest()->first();

        $employee = Employee::with([
            'category',
            'familyState' => function($query) {
                $query->where('relationType', RelationTypeEnum::CHILD->value);
            }
        ])->findOrFail($this->employee_id);

        $advance = Advance::where('employee_id', $this->employee_id)
                  ->where('credit_amount', '>', 0)
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
        
        $this->totalDue = round(($this->baseSalary + $this->overtimesPay + $this->assudityBonus + $this->riskBonus + $this->performanceBonus + $this->justifyDayPay) - $this->restDayCost, 2);
       
        $this->totalAdvantage = round($this->housingMounth + $this->transportationCostMounth + $this->familialAllocationMounth, 2);
        
        $this->brutSalary = round($this->totalAdvantage + $this->totalDue, 2);

        $this->totalAddiction = round($this->overtimesPay + $this->assudityBonus + $this->riskBonus + $this->performanceBonus + $this->justifyDayPay, 2);

        $this->CNSS = $deduction->CNSS;
        $this->INPP = $deduction->INPP;
        $this->IPR = $deduction->IPR;
        $this->ONEM = $deduction->ONEM;
        $this->refund = $deduction->refundAdvanceAmount;
        $this->deductionSalary = $deduction->deductionSalary;

        $this->CNSSAmount = round(($this->brutSalary * $this->CNSS) / 100, 2);
        $this->INPPAmount = round(($this->brutSalary * $this->INPP) / 100, 2);
        $this->IPRAmount  = round(($this->brutSalary * $this->IPR) / 100, 2);
        $this->ONEMAmount = round(($this->brutSalary * $this->ONEM) / 100, 2);

        if ($advance) {
            // On compare le montant prévu ($this->refundAmount) avec la dette réelle ($advance->remainToPay)
            // On prend le plus petit des deux pour ne pas prélever plus que la dette.
            
            $this->amountToDeduct = min($this->refundAmount, $advance->remainToPay);
        } else {
            $this->amountToDeduct = 0;
        }

        $this->totalDeduction = round($this->CNSSAmount 
                                + $this->INPPAmount 
                                + $this->IPRAmount 
                                + $this->ONEMAmount 
                                + $this->amountToDeduct, 2);

        $this->netSalary = round($this->brutSalary - $this->totalDeduction, 2);

        $id = Auth::id();
        $payment = Payment::create([
            'employee_id' => $this->employee_id, 
            'motif' => $motif, 
            'user_id' => $id,
            'netSalary' => $this->netSalary,
            //JSON
            'slipPrint'=>[
                //Employee section
                'function' => $employee?->category?->function,
                'section' => $employee?->section,
                'department' => $employee?->department,
                'site' => $employee?->site,
                'category' => $employee?->category,
                'accountNumber' => $employee?->accountNumber,
                'childCount' => $this->childCount,
                'baseSalary' => $this->baseSalary,
                'workDay' => $this->workDay,
                //Invoice section 1 brutDue and total
                'abscence' => $this->restDay,
                'absencePay' => $this->restDayCost,
                'justify' => $this->justify,
                'justifyPay' => $this->justifyPay,
                'overtimes' => $this->overtimes,
                'overtimesPay' => $this->overtimesPay,
                'assuduity' => $this->assudityBonus,
                'risk' => $this->riskBonus,
                'performance' => $this->performanceBonus,
                'totalAddiction' => $this->totalAddiction,
                'brutDue' => $this->totalDue,
                //Invoice section 2 Social advantage
                'housing' => $this->housingMounth,
                'transportation' => $this->transportationCostMounth,
                'familialAllocation' => $this->familialAllocationMounth,
                'totalAdvantage' => $this->totalAdvantage,
                'totalDeduction' => $this->totalDeduction,
                'brutSalary' => $this->brutSalary,
                //Invoice section 3 Deductions
                'CNSS' => $this->CNSS,
                'ONEM' => $this->ONEM,
                'INPP' => $this->INPPAmount,
                'IPR' => $this->IPR,
                'toRefundAdvance' => $this->refund,
                'salaryDeduction' => $this->deductionSalary,
                'CNSSAmount' => $this->CNSSAmount,
                'ONEMAmount' => $this->ONEMAmount,
                'INPPAmount' => $this->INPPAmount,
                'IPRAmount' => $this->IPRAmount,
                'toRefundAdvance' => $this->refundAmount,
                'salaryDeductionAmount' => $this->deductionSalaryAmount,
            ], 
        ]);
        session()->flash('success', "Successfuly!...");
        return redirect()->route('payment.print', $payment->id);

    }

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
