<?php

namespace App\Livewire\Module\User;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use Spatie\Permission\Models\Permission;
use App\Models\Category;
use Livewire\Attributes\Validate;
use App\Models\Enrollment;
use App\Models\FunctionType;

#[Layout('layouts.app')]
class UserCreate extends Component
{
    //Var for auto complete employee
    public $search = '';

    #[Validate('required|min:3')]
    public $identifiant;
    public $itemsEmployee = [];
    public $selectedEmployee = [null];
    public $employee_id;

    public function searchEmployee(): void
        {
            if (strlen($this->search) < 1 || str_contains($this->search, ' - ')) {
                $this->itemsEmployee = [];
                return;
            }

            // 1. Catch collection with relations
            $enrollments = Enrollment::with(['employee', 'functionType'])
                ->where(function ($query) {
                    $query->where('matricule', 'like', '%' . $this->search . '%')
                    ->orWhereHas('employee', function ($q) {
                        $q->where('firstName', 'like', '%' . $this->search . '%')
                        ->orWhere('lastName', 'like', '%' . $this->search . '%')
                        ->orWhere('middleName', 'like', '%' . $this->search . '%');
                    });
                })
                ->limit(5)
                ->get();

            // 2. Simple table "Livewire-friendly"
            $this->itemsEmployee = $enrollments->map(function ($item) {
                return [
                    'id'            => $item->id,
                    'matricule'     => $item->matricule,
                    // Security : if employee relation is True
                    'full_name'     => $item->employee 
                                        ? "{$item->employee->lastName} {$item->employee->firstName}" 
                                        : 'Employé inconnu',
                    // Security : Catch amount from Cast Money and convert to float
                    'base_salary'   => $item->functionType?->amount?->getAmount()->toFloat() ?? 0,
                    'function_name' => $item->functionType?->nameFunction ?? 'N/A',
                ];
            })->all(); // .all() ou .toArray()
        }

        //Selected Employee
    public function selectEmployee($itemId): void
    {
        // Select enrollment with his relations
        $enrollment = Enrollment::with(['employee', 'functionType'])->find($itemId);

        if ($enrollment) {
            $this->employee_id = $enrollment->employee_id; 
            $this->enrollment_id = $enrollment->id;
            
            $emp = $enrollment->employee;
            // Update search field with full name
            $this->search = "{$enrollment->matricule} - {$emp->lastName} {$emp->firstName}";
            
            // close 
            $this->itemsEmployee = [];
        }
    }

    public function submitUser()
    {
        $this->validate();
        if($this->employee_id)
        {
            $category = FunctionType::find($this->employee_id);
            $name = $category->nameFunction;
            $create = User::Create([
                'name' => $this->search,
                'identifiant' => $this->identifiant,
                'password' => Hash::make('password'),
            ]);

            $userRole = Role::FirstOrCreate(['name' => $name]);
            $create->assignRole($userRole);
            session()->flash('success', "L'Utilisateur a été créé avec succès.");
            return redirect()->to(route('user.index'));
        }
        session()->flash('danger', "Aucun agent n'a été selectionné.");
        return redirect()->to(route('user.create'));
    }
    
    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
