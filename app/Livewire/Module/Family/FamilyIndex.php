<?php

namespace App\Livewire\Module\Family;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;

#[Layout('layouts.app')]
class FamilyIndex extends Component
{
    public $fullName; 
    public $matricule; 
    public $nameCategory; 

    public function mount($id)
    {
        $employee = Employee::findOrFail($id);
        $this->fullName = $employee->middleName ." ". $employee->lastName ." ". $employee->firstName;
        $this->matricule = $employee->matricule;
    }

    public function render()
    {
        return view('livewire.module.family.family-index');
    }
}
