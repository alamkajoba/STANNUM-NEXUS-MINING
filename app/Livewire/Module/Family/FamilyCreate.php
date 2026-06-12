<?php

namespace App\Livewire\Module\Family;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Enums\GenderEnum;
use App\Models\Employee;
use App\Enums\RelationTypeEnum;
use Livewire\Attributes\Validate;
use Illuminate\Validation\Rules\Enum;
use App\Models\FamilyState;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class FamilyCreate extends Component
{

    //Var for auto complete employee
    public $search = '';
    public $itemsEmployee = [];
    public $selectedEmployee = [null];
    public $employeeId;

    public $convertMiddleName;
    public $convertLastName;
    public $convertFirstName;

    #[Validate(['required', 'string', 'min:2', 'max:50'])]
    public $firstName;

    #[Validate(['required', 'string', 'min:2', 'max:50'])]
    public $middleName;

    #[Validate(['required', 'string', 'min:2', 'max:50'])]
    public $lastName;

    #[Validate(['required', new Enum(GenderEnum::class)])]
    public $gender;

    #[Validate(['required', 'date', 'before:today'])]
    public $birthDate;

    #[Validate(['required', 'string', 'max:100'])]
    public $birthTown;

    #[Validate(['required', new Enum(RelationTypeEnum::class)])]
    public $relationType;

    public function searchEmployee(): void
    {
        //Looking for items
        $this->itemsEmployee = Employee::where('firstName', 'like', '%'.$this->search.'%')
            ->orwhere('lastName', 'like', '%'.$this->search.'%')
            ->orwhere('middleName', 'like', '%'.$this->search.'%')
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
        $this->itemsEmployee = []; // Vide les suggestions

    }

    public function submitFamily()
    {
        //Check if exist
        $this->convertFirstName = Str::lower(trim($this->firstName));
        $this->convertMiddleName = Str::lower(trim($this->middleName));
        $this->convertLastName = Str::lower(trim($this->lastName));

        $existFamily = FamilyState::whereRaw('LOWER(firstName) = ?', [$this->convertFirstName])
            ->whereRaw('LOWER(middleName) = ?', [$this->convertMiddleName])
            ->whereRaw('LOWER(lastName) = ?', [$this->convertLastName])
            ->where('birthDate', $this->birthDate)
            ->exists();

        if ($existFamily) {
            session()->flash('danger', "Ce membre existe déjà!...");
            return redirect()->route('family.create');
        }

        $employee = Employee::where('id', $this->employeeId)->first();
        if($employee)
        {
            $id = Auth::id();
            $family = FamilyState::create([
                'middleName' => $this->middleName,
                'lastName' => $this->lastName,
                'firstName' => $this->firstName,
                'birthTown' => $this->birthTown,
                'birthDate' => $this->birthDate,
                'relationType' => $this->relationType,
                'gender' => $this->gender,
                'employee_id' => $this->employeeId,
                'user_id' => $id
            ]);
            session()->flash('success', "Nouveau membre ajouté!...");
            return redirect()->route('family.create');
        }
        else
        {
            session()->flash('danger', "Aucun agent avec ces identifiants!...");
            return redirect()->route('family.create');
        }
        
    }

    // Gender Enum
    private function gender(): array
    {
        return GenderEnum::cases();
    }
    // Type Enum
    private function relation(): array
    {
        return RelationTypeEnum::cases();
    }
    
    public function render()
    {
        return view('livewire.module.family.family-create');
    }
}
