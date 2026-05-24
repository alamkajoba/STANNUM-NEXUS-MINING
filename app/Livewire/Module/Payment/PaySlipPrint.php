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
    public $salaryBonus;
    public $totalSocialBonus;

    public $deduction;

    public function mount($id)
    {
        $this->payment = Payment::with(['employee.category', 'employee.advance'])->find($id);
        $this->totalBonus = $this->payment->performanceBonus + $this->payment->overtimesPay+$this->payment->assudityBonus+$this->payment->riskBonus;
        $this->totalBonus = $this->totalBonus + $this->payment->employee?->category?->amount;
        $this->totalSocialBonus = $this->payment->employee?->category?->housing + 
        $this->payment->employee?->category?->transportationCost + $this->payment->employee?->category?->dayFamilialAllocation;
        $this->deduction = Deduction::latest()->first();
    }

    public function render()
    {
        return view('livewire.module.payment.pay-slip-print');
    }
}
