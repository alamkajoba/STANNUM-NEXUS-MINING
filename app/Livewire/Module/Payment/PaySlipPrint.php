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

    public function mount($id)
    {
        $this->payment = Payment::with(['user','employee.enrollment'])->find($id);
    }

    public function render()
    {
        return view('livewire.module.payment.pay-slip-print');
    }
}
