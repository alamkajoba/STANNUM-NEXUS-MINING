<?php

namespace App\Livewire\Module\Deduction;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class DeductionUpdate extends Component
{
    public function render()
    {
        return view('livewire.module.deduction.deduction-update');
    }
}
