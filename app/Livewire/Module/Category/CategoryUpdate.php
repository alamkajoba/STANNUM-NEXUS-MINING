<?php

namespace App\Livewire\Module\Category;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class CategoryUpdate extends Component
{
    #[Validate('required|min:3|string')]
    public $nameCategory = '';

    #[Validate('required')]
    public $amount = '';

    #[Validate('required')]
    public $workDay = '';

    #[Validate('nullable')]
    public $housing = '';

    #[Validate('nullable')]
    public $transportationCost = '';

    #[Validate('nullable')]
    public $familialAllocation = '';

    public $categoryId;
    
    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->nameCategory = $category->nameCategory;
        $this->amount = $category->amount;
        $this->workDay = $category->workDay;
        $this->housing = $category->housing;
        $this->familialAllocation = $category->familialAllocation;
        $this->transportationCost = $category->transportationCost;
        $this->categoryId = $category->id;
    }

    private function dataCategory(): array
    {
        $dayAmount = $this->amount / max(1, $this->workDay);
        $hourAmount = $dayAmount / 8;

        $id = Auth::id();
        return [
            'nameCategory' => $this->nameCategory,
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

        $category = Category::find($this->categoryId);
        $category->update($this->dataCategory());
        session()->flash('success', "La categorie: ".$this->nameCategory. " a été modifiéé avec succès.");
        return redirect()->to(route('category.index'));
    }

    public function render()
    {
        return view('livewire.module.category.category-update');
    }
}
