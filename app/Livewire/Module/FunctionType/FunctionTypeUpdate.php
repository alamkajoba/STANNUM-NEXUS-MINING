<?php

namespace App\Livewire\Module\FunctionType;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\FunctionType;

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
    
    public $functionId;
    
    public function mount($id)
    {
        $function = FunctionType::findOrFail($id);
        $this->nameFunction = $function->nameFunction;
        $this->amount = $function->amount;
        $this->workDay = $function->workDay;
        $this->housing = $function->housing;
        $this->familialAllocation = $function->familialAllocation;
        $this->transportationCost = $function->transportationCost;
        $this->functionId = $function->id;
    }

    private function dataFunctionType(): array
    {
        $dayAmount = $this->amount / max(1, $this->workDay);
        $hourAmount = $dayAmount / 8;

        $id = Auth::id();
        return [
            'nameFunction' => $this->nameFunction,
            'amount' => $this->amount,
            'dayAmount' => $dayAmount,
            'hourAmount' => $hourAmount,
            'workDay' => $this->workDay,
            'familialAllocation' => $this->familialAllocation,
            'housing' => $this->housing,
            'transportationCost' => $this->transportationCost,
            'user_id' => $id
        ];
    }

    public function updateCategory()
    {
        $this->validate();

        $function = FunctionType::find($this->functionId);
        $function->update($this->dataFunctionType());
        session()->flash('success', "La Fonction: ".$this->nameFunction. " a été modifiéé avec succès.");
        return redirect()->to(route('function.index'));
    }

    public function render()
    {
        return view('livewire.module.function-type.function-type-update');
    }
}
