<?php

namespace App\Livewire\Module\Deduction;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Deduction;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class DeductionUpdate extends Component
{
    #[Validate('nullable')]
    public $CNSS = '';

    #[Validate('nullable')]
    public $INPP = '';

    #[Validate('nullable')]
    public $IPR = '';

    #[Validate('nullable')]
    public $ONEM = '';

    #[Validate('nullable')]
    public $refundAdvanceAmount = '';

    #[Validate('nullable')]
    public $deductionSalary = '';

    public $deductionId;
    
    public function mount($id)
    {
        $deduction = Deduction::findOrFail($id);
        $this->CNSS = $deduction->CNSS;
        $this->INPP = $deduction->INPP;
        $this->IPR = $deduction->IPR;
        $this->ONEM = $deduction->ONEM;
        $this->refundAdvanceAmount = $deduction->refundAdvanceAmount;
        $this->deductionSalary = $deduction->deductionSalary;
        $this->deductionId = $deduction->id;
    }

    private function dataDeduction(): array
    {
        $id = Auth::id();
        return [
            'CNSS' => $this->CNSS,
            'INPP' => $this->INPP,
            'IPR' => $this->IPR,
            'ONEM' => $this->ONEM,
            'refundAdvanceAmount' => $this->refundAdvanceAmount,
            'deductionSalary' => $this->deductionSalary,
            'user_id' => $id
        ];
    }

    public function updateDeduction()
    {
        $this->validate();

        $deduction = Deduction::find($this->deductionId);
        $deduction->update($this->dataDeduction());
        session()->flash('success', "Les déductions ont été modifiées avec succès.");
        return redirect()->to(route('deduction.index'));
    }
    public function render()
    {
        return view('livewire.module.deduction.deduction-update');
    }
}
