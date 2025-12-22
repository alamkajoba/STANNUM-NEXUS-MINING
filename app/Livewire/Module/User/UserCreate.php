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

#[Layout('layouts.app')]
class UserCreate extends Component
{
    //Var for auto complete employee
    public $search = '';
    public $identifiant;
    public $itemsEmployee = [];
    public $selectedEmployee = [null];
    public $employeeId;

    public function searchEmployee(): void
    {
        //Looking for items
        $this->itemsEmployee = Employee::where('firstName', 'like', '%'.$this->search.'%')
            ->orwhere('lastName', 'like', '%'.$this->search.'%')
            ->orwhere('middleName', 'like', '%'.$this->search.'%')
            ->orwhere('matricule', 'like', '%'.$this->search.'%')
            ->limit(3)
            ->get()
            ->toArray();
    }

    //Selected Employee
    public function selectEmployee($itemId): void
    {
        // Sélectionne un élément
        $this->selectedEmployee = Employee::find($itemId)->toArray();
        $this->search = $this->selectedEmployee['middleName'].' '.$this->selectedEmployee['lastName'].' '.$this->selectedEmployee['firstName'];
        $this->employeeId = $this->selectedEmployee['id'];
        $this->category_id = $this->selectedEmployee['category_id'];
        $this->itemsEmployee = []; // Vide les suggestions

    }

    public function submitUser()
    {
        $category = Category::find($this->employeeId);
        $name = $category->nameCategory;
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
    
    public function render()
    {
        return view('livewire.module.user.user-create');
    }
}
