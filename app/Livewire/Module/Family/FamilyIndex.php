<?php

namespace App\Livewire\Module\Family;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class FamilyIndex extends Component
{
    public function render()
    {
        return view('livewire.module.family.family-index');
    }
}
