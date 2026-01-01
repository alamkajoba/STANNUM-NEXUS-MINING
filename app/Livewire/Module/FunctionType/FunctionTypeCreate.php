<?php

namespace App\Livewire\Module\FunctionType;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use App\Models\Employee;
use App\Models\FunctionType;

#[Layout('layouts.app')]
class FunctionTypeCreate extends Component
{

    public $convertName;

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

    private function dataCategory(): array
    {
        $dayAmount = $this->amount / max(1, $this->workDay);
        $hourAmount = $dayAmount / 8;
        $id = Auth::id();

        // dd($this->amount);
        return [
            'nameFunction' => $this->nameFunction,
            'amount' => $this->amount,
            'dayAmount' => $dayAmount,
            'hourAmount' => $hourAmount,
            'workDay' => $this->workDay,
            'housing' => $this->housing,
            'transportationCost' => $this->transportationCost,
            'familialAllocation' => $this->familialAllocation,
            'user_id' => $id
        ];
    }

    public function submitCategory()
    {
        $this->validate();

        //Check if exist
        $this->convertName = Str::lower(trim($this->nameFunction));

        $existCategory = FunctionType::whereRaw('LOWER(nameFunction) = ?', [$this->convertName])
            ->exists();

        if ($existCategory) {
            session()->flash('danger', "Cette Fonction existe déjà!...");
            return redirect()->route('function.create');
        }

        $employee = FunctionType::create($this->dataCategory());
        session()->flash('success', "La Fonction a été créé avec succès.");
        return redirect()->to(route('function.index'));
    }


    public function render()
    {
        return view('livewire.module.function-type.function-type-create');
    }
}
