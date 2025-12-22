<?php

namespace App\Livewire\Module\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class UserUpdate extends Component
{
    public function render()
    {
        return view('livewire.module.user.user-update');
    }
}
