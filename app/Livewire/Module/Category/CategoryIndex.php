<?php

namespace App\Livewire\Module\Category;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Url;
use App\Models\Category;

#[Layout('layouts.app')]
class CategoryIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {

        $category = Category::search($this->search)
                ->latest()
                ->paginate(5);

            
        return view('livewire.module.category.category-index', [
            'category' => $category,
        ]);
    }
}
