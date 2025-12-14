<?php

namespace App\Livewire\Module\Deduction;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use App\Models\Category;
use App\Models\Deduction;

#[Layout('layouts.app')]
class DeductionCreate extends Component
{

    public $convertName;

    #[Validate('nullable')]
    public $CNSS = 0;

    #[Validate('nullable')]
    public $INPP = 0;

    #[Validate('nullable')]
    public $IPR = 0;

    #[Validate('nullable')]
    public $ONEM = 0;

    #[Validate('nullable')]
    public $refundAdvanceAmount = 0;

    #[Validate('nullable')]
    public $deductionSalary = 0;

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

    public function submitDeduction()
    {
        $this->validate();

        $employee = Deduction::create($this->dataDeduction());
        session()->flash('success', "La deduction a été créé avec succès.");
        return redirect()->to(route('deduction.index'));
    }


    public function render()
    {
        return view('livewire.module.deduction.deduction-create');
    }
}
