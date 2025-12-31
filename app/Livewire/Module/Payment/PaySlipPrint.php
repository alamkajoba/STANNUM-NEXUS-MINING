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
    public $refund = 0;

    // Advance repayment history
    public $advance;
    public $advanceRepayments = [];
    public $totalRepaid = 0.00;
    public $remainingAdvance = 0.00;

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
        // Include any advance refund applied on the payment
        $this->refund = $this->payment->refundAmount ?? 0;
        $this->totalDeduction = ($this->IPR + $this->CNSS + $this->ONEM + $this->INPP + $this->deductionSalary + $this->refund);
        $this->totalSalary = $this->brutSalary - $this->totalDeduction;

        // Load active advance and its repayment history for this employee
        $this->advance = \App\Models\Advance::where('employee_id', $this->payment->employee->id)
                            ->orderByDesc('created_at')
                            ->first();

        if ($this->advance) {
            $this->advanceRepayments = $this->advance->repayments()->with(['payment', 'user'])->get();
            $this->totalRepaid = (float) $this->advanceRepayments->sum('amount');
            // remainingAdvance is whatever toRefund currently shows
            $this->remainingAdvance = (float) $this->advance->toRefund;
        } else {
            $this->advanceRepayments = collect();
            $this->totalRepaid = 0.00;
            $this->remainingAdvance = 0.00;
        }
    }

    public function render()
    {
        return view('livewire.module.payment.pay-slip-print');
    }
}
