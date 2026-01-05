<?php

namespace App\Livewire\Module\Advance;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\AdvanceRepayment;
use App\Models\Advance;

#[Layout('layouts.app')]
class AdvanceHistory extends Component
{
    public $search = '';
    public $repayments;
    public $totalRepaid = 0.00;
    public $byAgent = []; // grouped totals by employee
    public $totalAdvances = 0.00; // total of all advances

    public function mount()
    {
        // Load all repayments
        $this->repayments = AdvanceRepayment::with(['advance.employee', 'payment', 'user'])
                            ->orderByDesc('paid_at')
                            ->get();
        $this->totalRepaid = (float) $this->repayments->sum('amount');

        // Build initial agent data
        $this->buildByAgent();
    }

    public function updatedSearch()
    {
        $this->buildByAgent();
    }

    protected function buildByAgent()
    {
        // Build query for COMPLETED advances (toRefund = 0)
        $advancesQuery = Advance::with('employee')
                                              ->where('toRefund', 0);

        // If a search is provided, apply it at the query level for reliability
        if (!empty(trim($this->search))) {
            $s = '%'.trim($this->search).'%';
            $advancesQuery->whereHas('employee', function($q) use ($s) {
                $q->where('firstName', 'like', $s)
                  ->orWhere('middleName', 'like', $s)
                  ->orWhere('lastName', 'like', $s)
                  ->orWhere('matricule', 'like', $s);
            });
        }

        $advances = $advancesQuery->get();

        $this->totalAdvances = (float) $advances->sum('amount');

        $advancesByEmployee = $advances->groupBy('employee_id');

        // Build comprehensive per-agent data for completed advances only
        $this->byAgent = $advancesByEmployee->map(function($empAdvances, $employeeId) {
            $employee = $empAdvances->first()->employee;
            $totalAdvanceAmount = (float) $empAdvances->sum('amount');
            $totalRemaining = (float) $empAdvances->sum('toRefund');

            // Get repayments for this employee
            $repayments = $this->repayments->filter(function($r) use ($employeeId) {
                return !is_null($r->advance) && $r->advance->employee_id == $employeeId;
            });
            $totalRepaid = (float) $repayments->sum('amount');

            return [
                'employee' => $employee,
                'totalAdvanceAmount' => $totalAdvanceAmount,
                'totalRepaid' => $totalRepaid,
                'remaining' => $totalRemaining,
                'repayments' => $repayments->sortByDesc('paid_at'),
                'advances' => $empAdvances,
            ];
        })->values()->all();
    }

    public function render()
    {
        return view('livewire.module.advance.advance-history');
    }
}
