<?php

namespace App\Livewire\Module\FunctionType;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Url;
use App\Models\Category;
use App\Models\FunctionType;

#[Layout('layouts.app')]
class FunctionTypeIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {

        $category = FunctionType::search($this->search)
                ->latest()
                ->paginate(5);

            
        return view('livewire.module.function-type.function-type-index', [
            'category' => $category,
        ]);
    }
}
