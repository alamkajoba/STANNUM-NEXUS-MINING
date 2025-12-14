<?php

namespace App\Livewire\Module\HomePage;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.module.home-page.home-page');
    }
}
