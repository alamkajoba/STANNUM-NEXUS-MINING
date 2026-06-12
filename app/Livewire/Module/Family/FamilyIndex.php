<?php

namespace App\Livewire\Module\Family;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Enrollment;

#[Layout('layouts.app')]
class FamilyIndex extends Component
{
    public $enrollment; 

    public function mount($id)
    {
        $this->enrollment = Enrollment::with(['employee.familyState', 'functionType'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.module.family.family-index');
    }
}
