<?php

namespace App\Livewire\Module\FunctionType;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\FunctionType;
use Brick\Money\Money;
use Brick\Math\RoundingMode;

#[Layout('layouts.app')]
class FunctionTypeUpdate extends Component
{
     #[Validate('required|min:3|string')]
    public $nameFunction = '';

    #[Validate('required|numeric|min:0')]
    public $amount = 0.00;

    #[Validate('nullable|numeric|min:1|max:31')]
    public $workDay = 1;

    #[Validate('nullable|numeric|min:0')]
    public $housing = 0.00;

    #[Validate('nullable|numeric|min:0')]
    public $transportationCost = 0.00;

    #[Validate('nullable|numeric|min:0')]
    public $familialAllocation = 0.00;

    public FunctionType $functionType;
    
    public function mount(FunctionType $functionType)
    {
        $this->functionType = $functionType;

        $this->nameFunction = $functionType->nameFunction;
        $this->workDay      = $functionType->workDay;

        $this->amount             = $functionType?->amount->getAmount()->toFloat();
        $this->housing            = $functionType?->housing->getAmount()->toFloat();
        $this->transportationCost = $functionType?->transportationCost->getAmount()->toFloat();
        $this->familialAllocation = $functionType?->familialAllocation->getAmount()->toFloat();
    }

    private function dataFunctionType(): array
    {
        $baseMoney    = Money::of($this->amount, 'USD');
        $housing      = Money::of($this->housing, 'USD');
        $transport    = Money::of($this->transportationCost, 'USD');
        $allocation   = Money::of($this->familialAllocation, 'USD');


        $dayAmount = $baseMoney->dividedBy($this->workDay, RoundingMode::HALF_UP);
        $hourAmount = $dayAmount->dividedBy(8, RoundingMode::HALF_UP);

        $id = Auth::id();
        return [
            'nameFunction' => $this->nameFunction,
            'amount' => $baseMoney,
            'dayAmount' => $dayAmount,
            'hourAmount' => $hourAmount,
            'workDay' => $this->workDay,
            'familialAllocation' => $allocation,
            'housing' => $housing,
            'transportationCost' => $transport,
            'user_id' => $id
        ];
    }

    public function updateCategory()
    {
        $this->validate();

        $this->functionType->update($this->dataFunctionType());
        session()->flash('success', "La Fonction: ".$this->nameFunction. " a été modifiéé avec succès.");
        return redirect()->to(route('function.index'));
    }

    public function render()
    {
        return view('livewire.module.function-type.function-type-update');
    }
}
