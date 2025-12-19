<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Payment;
use App\Models\Deduction;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Advance;

#[Layout('layouts.print')]
class PaySlipPrint extends Component
{
    //For invoice
    //Payment
    public $motif;
    public $totalAmount = 0.00;
    public $netAmount = 0.00;
    public $restDay;
    public $overtimes;
    public $overtimesPay = 0.00;
    public $assudityBonus = 0.00;
    public $riskBonus = 0.00;
    public $performanceBonus = 0.00;
    public $actifDay;

    //Deduction
    public $CNSS; 
    public $INPP; 
    public $ONEM;
    public $IPR;
    public $refundAdvanceAmount;
    public $deductionSalary;
    //Deduction amount
    public $CNSSAmount = 0.00; 
    public $INPPAmount = 0.00; 
    public $ONEMAmount = 0.00;
    public $IPRAmount = 0.00;
    public $deductionSalaryAmount = 0.00;
    public $refundAdvance_Amount = 0.00;
    //Category
    public $nameCategory; 
    public $amount = 0.00;
    public $workDay; 
    public $hourAmount = 0.00; 
    public $dayAmount = 0.00; 
    public $lunch = 0.00; 
    public $transportationCost = 0.00;
    //Employee
    public $firstName;
    public $middleName;
    public $lastName; 
    public $matricule;
    public $gender; 
    //Advance
    public $amountAdvance = 0.00;
    public $toRefund = 0.00;

    protected $rules = [
        'totalAmount'=> 'numeric|between:0,999999999999999.99',
        'netAmount'=> 'numeric|between:0,999999999999999.99',
        'overtimesPay'=> 'numeric|between:0,999999999999999.99',
        'assudityBonus'=> 'numeric|between:0,999999999999999.99',
        'riskBonus'=> 'numeric|between:0,999999999999999.99',
        'performanceBonus'=> 'numeric|between:0,999999999999999.99',
        'toRefund'=> 'numeric|between:0,999999999999999.99',
        'amountAdvance'=> 'numeric|between:0,999999999999999.99',
        'transportationCost'=> 'numeric|between:0,999999999999999.99',
        'lunch'=> 'numeric|between:0,999999999999999.99',
        'dayAmount'=> 'numeric|between:0,999999999999999.99',
        'hourAmount'=> 'numeric|between:0,999999999999999.99',
        'amount'=> 'numeric|between:0,999999999999999.99',
        'deductionSalaryAmount'=> 'numeric|between:0,999999999999999.99',
        'IPRAmount'=> 'numeric|between:0,999999999999999.99',
        'ONEMAmount'=> 'numeric|between:0,999999999999999.99',
        'INPPAmount'=> 'numeric|between:0,999999999999999.99',
        'CNSSAmount'=> 'numeric|between:0,999999999999999.99',
    ];

    // public function mount($id)
    // {
    //     // 1. Charger le paiement et ses relations en une seule fois
    //     $payment = Payment::with(['employee.category', 'employee.advances'])->findOrFail($id);
    //     $employee = $payment->employee;
    //     $category = $employee->category;
    //     $deduction = Deduction::first(); // Idéalement, stockez les taux dans Payment au moment du paiement

    //     // 2. Hydrater les variables simples
    //     $this->fill($payment->toArray()); // Remplit automatiquement les noms de colonnes correspondants
        
    //     // 3. Hydrater les variables liées (Employee)
    //     $this->firstName = $employee->firstName;
    //     $this->lastName = $employee->lastName;
    //     $this->matricule = $employee->matricule;

    //     // 4. Effectuer les calculs financiers
    //     if ($deduction) {
    //         $this->CNSSAmount = bcmul($payment->totalAmount, bcdiv($deduction->CNSS, "100", 3), 2);
    //         // ... répétez pour les autres
    //     }

    //     // 5. Gestion de l'avance (Correction de votre bug de find())
    //     $advance = $employee->advances()->first(); 
    //     if ($advance) {
    //         $this->toRefund = $advance->toRefund;
    //         $this->amountAdvance = $advance->amount;
    //     }
    // }
    
    public function mount($id)
    {
        //Payment
        $payment = Payment::findOrFail($id);
        $this->motif = $payment->motif;
        $this->totalAmount = $payment->totalAmount;
        $this->netAmount = $payment->netAmount;
        $this->restDay = $payment->restDay;
        $this->overtimes = $payment->overtimes;
        $this->assudityBonus = $payment->assudityBonus;
        $this->riskBonus = $payment->riskBonus;
        $this->performanceBonus = $payment->performanceBonus;
        $this->CNSS = $payment->CNSS; 
        $this->INPP = $payment->INPP; 
        $this->ONEM = $payment->ONEM;
        $this->IPR = $payment->IPR;
        $this->refundAdvanceAmount = $payment->refundAdvanceAmount;
        $this->deductionSalary = $payment->deductionSalary;

        $this->CNSSAmount = bcmul($this->totalAmount, ( bcdiv($this->CNSS, "100", 3))); 
        $this->INPPAmount = bcmul($this->totalAmount, ( bcdiv($this->INPP, "100", 3))); 
        $this->ONEMAmount = bcmul($this->totalAmount, ( bcdiv($this->ONEM, "100", 3))); 
        $this->IPRAmount = bcmul($this->totalAmount, ( bcdiv($this->IPR, "100", 3))); 
        $this->deductionSalaryAmount = bcmul($this->totalAmount, ( bcdiv($this->deductionSalary, "100", 3))); 
        $this->refundAdvance_Amount = bcmul($this->totalAmount, ( bcdiv($this->refundAdvanceAmount, "100", 3))); 
        //Employee
        $employee = Employee::findOrFail($payment->employee_id);
        $this->firstName = $employee->firstName; 
        $this->middleName = $employee->middleName; 
        $this->lastName = $employee->lastName;
        $this->matricule = $employee->matricule;
        $this->gender = $employee->gender;

        //Category
        $category = Category::findOrFail($employee->category_id);
        $this->nameCategory = $category->nameCategory; 
        $this->hourAmount = $category->hourAmount; 
        $this->amount = $category->amount;
        $this->workDay = $category->workDay; 
        $this->lunch = $category->lunch; 
        $this->transportationCost = $category->transportationCost;
        $this->dayAmount = $category->dayAmount;
        $this->overtimesPay = bcmul($this->hourAmount, $this->overtimes);
        $this->actifDay = $this->workDay - $this->restDay;

        //Advance
        $advance = Advance::where('employee_id', $employee->id)->first();
        if($advance)
        {
            $this->toRefund = $advance->toRefund; 
            $this->amountAdvance = $advance->amount; 
        }

    }

    public function render()
    {
        return view('livewire.module.payment.pay-slip-print');
    }
}
