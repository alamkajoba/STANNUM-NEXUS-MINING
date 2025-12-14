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
    public $totalAmount;
    public $netAmount;
    public $restDay;
    public $overtimes;
    public $assudityBonus;
    public $riskBonus;
    public $performanceBonus;

    //Deduction
    public $CNSS; 
    public $INPP; 
    public $ONEM;
    public $IPR;
    public $refundAdvanceAmount;
    //Category
    public $nameCategory; 
    public $amount;
    public $workDay; 
    public $lunch; 
    public $transportationCost;
    //Employee
    public $firstName;
    public $middleName;
    public $lastName; 
    public $matricule;
    public $gender; 
    //Advance
    public $amountAdvance;
    public $toRefund;
    
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

        //Deduction
        $deduction = Deduction::first();
        $this->CNSS = $deduction->CNSS; 
        $this->INPP = $deduction->INPP; 
        $this->ONEM = $deduction->ONEM;
        $this->IPR = $deduction->IPR;
        $this->refundAdvanceAmount = $deduction->refundAdvanceAmount;

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
        $this->amount = $category->amount;
        $this->workDay = $category->workDay; 
        $this->lunch = $category->lunch; 
        $this->transportationCost = $category->transportationCost;

        //Advance
        $advance = Advance::find($employee->employee_id);
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
