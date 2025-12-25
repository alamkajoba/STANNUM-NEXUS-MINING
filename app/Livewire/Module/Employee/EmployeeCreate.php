<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Enums\GenderEnum;
use App\Models\Category;
use Livewire\Attributes\Validate;

#[Layout('layouts.app')]
class EmployeeCreate extends Component
{

    public $convertMiddleName;
    public $convertLastName;
    public $convertFirstName;

    public $step = 1;

    // Champs du formulaire
    public $firstName, $middleName, $lastName, $gender, $birthDate, $birthTown;
    public $phone, $emergencyPhone, $mail, $address, $nationalite;
    public $proMail, $proPhone, $jobTitle, $affectation, $categoryName, $user_id;

    public function nextStep() {
        $rules = [
            1 => [
                'firstName' => 'required', 'middleName' => 'required', 'lastName' => 'required',
                'gender' => 'required', 'birthDate' => 'required', 'birthTown' => 'required'
            ],
            2 => [
                'phone' => 'required', 'address' => 'required', 'nationalite' => 'required'
            ]
        ];

        $this->validate($rules[$this->step]);
        $this->step++;
    }

    public function previousStep() {
        $this->step--;
    }

    public function generateNextMatricule()
    {
        // On récupère le dernier employé enregistré par ID
        $lastEmployee = Employee::latest('id')->first();

        // Si aucun employé n'existe, on commence à 1, sinon on fait ID + 1
        $nextId = $lastEmployee ? ($lastEmployee->id + 1) : 1;

        // On formate avec STN- et 3 chiffres (ex: STN-001, STN-020)
        return 'STN-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);
    }


    public function saveEmployee() {
        $rules = ([
            'jobTitle' => 'required', 'categoryName' => 'required'
        ]);
        $this->validate($rules);

        //Check if exist
        $this->convertFirstName = Str::lower(trim($this->firstName));
        $this->convertMiddleName = Str::lower(trim($this->middleName));
        $this->convertLastName = Str::lower(trim($this->lastName));

        $existEmployee = Employee::whereRaw('LOWER(firstName) = ?', [$this->convertFirstName])
            ->whereRaw('LOWER(middleName) = ?', [$this->convertMiddleName])
            ->whereRaw('LOWER(lastName) = ?', [$this->convertLastName])
            ->where('birthDate', $this->birthDate)
            ->exists();

        if ($existEmployee) {
            session()->flash('danger', "Cet Agent existe déjà!...");
            return redirect()->route('employee.create');
        }

        $matricule = $this->generateNextMatricule();

        $id = Auth::id();
        // Ta logique d'insertion ici
        $employee = Employee::Create([
            'firstName' => $this->firstName, 
            'matricule' => $matricule, 
            'middleName' => $this->middleName, 
            'lastName' => $this->lastName, 
            'birthDate' => $this->birthDate, 
            'birthTown' => $this->birthTown, 
            'gender' => $this->gender, 
            'phone' => $this->phone, 
            'emergencyPhone' => $this->emergencyPhone, 
            'mail' => $this->mail, 
            'address' => $this->address, 
            'nationality' => $this->nationalite,
            'proMail' => $this->proMail,
            'category_id' => $this->categoryName, 
            'user_id' => $id,
            'proPhone' => $this->proPhone,
            'jobTitle' => $this->jobTitle,
            'affectation' => $this->affectation,
        ]);

        session()->flash('success', 'Agent ajouté avec succès');
        return redirect()->route('employee.index');
    }

    // Gender Enum
    private function gender(): array
    {
        return GenderEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-create', [
        'selectCategory' => \App\Models\Category::all(), // On récupère toutes les catégories
    ]);
    }
}
