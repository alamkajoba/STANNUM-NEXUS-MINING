<?php

namespace App\Livewire\Module\Advance;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Url;
use App\Models\Advance;

#[Layout('layouts.app')]
class AdvanceIndex extends Component
{

    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';
    
    public function render()
    {
        $advance = Advance::with('employee')
                          ->where('toRefund', '>', 0); // Only show active advances

        return view('livewire.module.advance.advance-index',[
            'advance' => $advance->latest()->paginate(5),
        ]);
    }
}
