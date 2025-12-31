<?php

namespace App\Livewire\Module\Advance;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Advance;

#[Layout('layouts.app')]
class AdvanceShow extends Component
{
    public $advance;
    public $advanceRepayments;
    public $totalRepaid = 0.00;
    public $remainingAdvance = 0.00;

    public function mount($id)
    {
        $this->advance = Advance::with(['employee'])->findOrFail($id);
        $this->advanceRepayments = $this->advance->repayments()->with(['user','payment'])->orderByDesc('paid_at')->get();
        $this->totalRepaid = (float) $this->advanceRepayments->sum('amount');
        $this->remainingAdvance = (float) $this->advance->toRefund;
    }

    public function render()
    {
        return view('livewire.module.advance.advance-show');
    }
}
