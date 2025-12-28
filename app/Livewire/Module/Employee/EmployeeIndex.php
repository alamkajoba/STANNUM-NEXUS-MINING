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
                ->search($this->search)
                ->latest()
                ->paginate(5);

            
        return view('livewire.module.employee.employee-index', [
            'employee' => $employee,
        ]);
    }
}
