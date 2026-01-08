<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Enrollment;

#[Layout('layouts.idCardPrint')]
class IdCardPrint extends Component
{
    public $enrollment; 

    public function mount($id)
    {
        $this->enrollment = Enrollment::with(['employee.familyState', 'functionType'])->findOrFail($id);
    }
    
    public function render()
    {
        return view('livewire.module.employee.id-card-print');
    }
}
