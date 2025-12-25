<?php

namespace App\Livewire\Module\Category;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\Attributes\Validate;
use App\Models\Employee;

#[Layout('layouts.app')]
class CategoryCreate extends Component
{

    public $convertName;

    #[Validate('required|min:3|string')]
    public $nameCategory = '';

    #[Validate('required')]
    public $amount = 0.00;

    #[Validate('required')]
    public $workDay = 1;

    #[Validate('nullable')]
    public $housing = 0.00;

    #[Validate('nullable')]
    public $transportationCost = 0.00;

    #[Validate('nullable')]
    public $familialAllocation = 0.00;

    private function dataCategory(): array
    {
        $dayAmount = $this->amount / $this->workDay;
        $hourAmount = $dayAmount / 8;
        $id = Auth::id();

        // dd($this->amount);
        return [
            'nameCategory' => $this->nameCategory,
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
        $this->convertName = Str::lower(trim($this->nameCategory));

        $existCategory = Category::whereRaw('LOWER(nameCategory) = ?', [$this->convertName])
            ->exists();

        if ($existCategory) {
            session()->flash('danger', "Cette categorie existe déjà!...");
            return redirect()->route('category.create');
        }

        $employee = Category::create($this->dataCategory());
        session()->flash('success', "La categorie a été créé avec succès.");
        return redirect()->to(route('category.index'));
    }


    public function render()
    {
        return view('livewire.module.category.category-create');
    }
}
