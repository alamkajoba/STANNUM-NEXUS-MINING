<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Url;
use App\Models\Employee;
use App\Models\Category;

#[Layout('layouts.app')]
class EmployeeIndex extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {

        $employee = Employee::with('category')
                ->where(function ($query) {
                    $searchTerm = '%' . $this->search . '%';
                    
                    
                    $query->where('firstName', 'like', $searchTerm)
                        ->orWhere('middleName', 'like', $searchTerm)
                        ->orWhere('lastName', 'like', $searchTerm)
                        ->orWhere('matricule', 'like', $searchTerm)
                        ->orWhere('affectation', 'like', $searchTerm)
                        ->orWhere('jobTitle', 'like', $searchTerm);
                        
                   
                    $query->orWhereHas('category', function ($q) use ($searchTerm) {
                        $q->where('nameCategory', 'like', $searchTerm); 
                    });
                })
                ->latest()
                ->paginate(5);

            
        return view('livewire.module.employee.employee-index', [
            'employee' => $employee,
        ]);
    }
}
