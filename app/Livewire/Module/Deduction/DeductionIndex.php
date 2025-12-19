<?php

namespace App\Livewire\Module\Deduction;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Deduction;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

#[Layout('layouts.app')]
class DeductionIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {

        $deduction = Deduction::where('deduction', 'like', '%' . $this->search . '%');

        return view('livewire.module.deduction.deduction-index', [
            'deduction' => $deduction->latest()->paginate(5),
        ]);
    }
}
