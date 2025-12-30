<?php

namespace App\Livewire\Module\Family;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;

#[Layout('layouts.app')]
class FamilyIndex extends Component
{
    public $employee; 

    public function mount($id)
    {
        $this->employee = Employee::with(['category', 'familyState'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.module.family.family-index');
    }
}
