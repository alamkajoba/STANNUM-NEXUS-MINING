<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Payment;
use App\Models\Deduction;

#[Layout('layouts.print')]
class PaySlipPrint extends Component
{
    public $payment;
    public $totalBonus;
    public $totalSocialBonus;
    public $deduction;
    public $brutSalary;
    public $totalDeduction;
    public $actifDay;

    public $INPP;
    public $CNSS;
    public $IPR;
    public $ONEM;
    public $deductionSalary;

    public $totalSalary;

    public function mount($id)
    {
        $this->payment = Payment::with(['employee.category', 'employee.advance'])->find($id);

        $this->deduction = Deduction::latest()->first();
        $this->totalBonus =     $this->payment->employee?->category?->amount +
                                $this->payment->riskBonus +
                                $this->payment->perfomrmaceBonus +
                                $this->payment->assuidityBonus +
                                $this->payment->overtimesPay;

        

        $this->totalSocialBonus = $this->payment->employee?->category?->housing + 
                                    $this->payment->employee?->category?->transportationCost + 
                                    $this->payment->employee?->category?->familialAllocation;

        $this->brutSalary = $this->totalSocialBonus + $this->totalBonus;
        $this->actifDay = $this->payment->employee?->category?->workDay - $this->payment->restDay;

        $this->IPR =  $this->brutSalary  *  ($this->deduction->IPR /100);
        $this->CNSS =  $this->brutSalary  *  ($this->deduction->CNSS /100);
        $this->ONEM =  $this->brutSalary  *  ($this->deduction->ONEM /100);
        $this->INPP =  $this->brutSalary  *  ($this->deduction->INPP /100);
        $this->deductionSalary =  $this->brutSalary  *  ($this->deduction->deductionSalary /100);
        $this->totalDeduction = ($this->IPR + $this->CNSS + $this->ONEM + $this->INPP + $this->deductionSalary);
        $this->totalSalary = $this->brutSalary - $this->totalDeduction;
    }

    public function render()
    {
        return view('livewire.module.payment.pay-slip-print');
    }
}
