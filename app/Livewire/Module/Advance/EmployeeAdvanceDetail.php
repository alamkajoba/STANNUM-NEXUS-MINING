<?php

namespace App\Livewire\Module\Advance;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use App\Models\Advance;

#[Layout('layouts.app')]
class EmployeeAdvanceDetail extends Component
{
    public $employee;
    public $advances;
    public $repayments;
    public $totalAdvanced = 0.00;
    public $totalRepaid = 0.00;
    public $totalRemaining = 0.00;

    public function mount($employeeId)
    {
        $this->employee = Employee::with('category')->findOrFail($employeeId);
        
        // Load all advances for this employee
        $this->advances = Advance::where('employee_id', $employeeId)
                                 ->orderByDesc('created_at')
                                 ->get();
        
        $this->totalAdvanced = (float) $this->advances->sum('amount');
        $this->totalRemaining = (float) $this->advances->sum('toRefund');
        
        // Load all repayments for this employee's advances
        $advanceIds = $this->advances->pluck('id');
        $this->repayments = \App\Models\AdvanceRepayment::whereIn('advance_id', $advanceIds)
                                                          ->with(['payment', 'user'])
                                                          ->orderByDesc('paid_at')
                                                          ->get();
        
        $this->totalRepaid = (float) $this->repayments->sum('amount');
    }

    public function render()
    {
        return view('livewire.module.advance.employee-advance-detail');
    }
}
