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
    public $lunch = '';

    #[Validate('nullable')]
    public $transportationCost = '';

    public $categoryId;
    
    public function mount($id)
    {
        $category = Category::findOrFail($id);
        $this->nameCategory = $category->nameCategory;
        $this->amount = $category->amount;
        $this->workDay = $category->workDay;
        $this->lunch = $category->lunch;
        $this->transportationCost = $category->transportationCost;
        $this->categoryId = $category->id;
    }

    private function dataCategory(): array
    {
        $dayAmount = $this->amount / $this->workDay;
        $hourAmount = $this->amount / 8;
        $id = Auth::id();
        return [
            'nameCategory' => $this->nameCategory,
            'amount' => $this->amount,
            'dayAmount' => $dayAmount,
            'hourAmount' => $hourAmount,
            'workDay' => $this->workDay,
            'lunch' => $this->lunch,
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
