<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use App\Models\Category;
use App\Enums\GenderEnum;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]

class EmployeeUpdate extends Component
{
    public $step = 1;
    public $employeeId;

    // Champs du formulaire
    public $firstName, $middleName, $lastName, $gender, $birthDate, $birthTown;
    public $phone, $emergencyPhone, $mail, $address, $nationalite;
    public $proMail, $proPhone, $jobTitle, $affectation, $categoryId, $categoryName, $user_id;
    
    // Liste pour les selects
    public $selectCategory;

    public function nextStep() {
        $rules = [
            1 => [
                'firstName' => 'required|string|min:2|regex:/^[a-zA-Z\s-]+$/u', 
                'middleName' => 'required|string|min:2|regex:/^[a-zA-Z\s-]+$/u', 
                'lastName' => 'required|string|min:2|regex:/^[a-zA-Z\s-]+$/u',
                'gender' => 'required', 
                'birthDate' => 'required|date', 
                'birthTown' => 'required|string|min:2'
            ],
            2 => [
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10', 
                'emergencyPhone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'mail' => 'nullable|string|email:rfc,dns',
                'address' => 'required|string|min:2', 
                'nationalite' => 'required|string|min:2'
            ]
        ];

        $this->validate($rules[$this->step]);
        $this->step++;
    }

    public function previousStep() {
        $this->step--;
    }

    public function saveEmployee() {
        $rules = [
            'jobTitle' => 'required|string|min:2', 
            'affectation' => 'required|string|min:2', 
            'proMail' => 'nullable|string|email:rfc,dns', 
            'proPhone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10', 
            'categoryId' => 'required'
        ];
        $this->validate($rules);

        // Correction : Utiliser $this->employeeId (car $id n'existe pas dans cette méthode)
        $employee = Employee::find($this->employeeId);
        
        $employee->update([
            'firstName' => $this->firstName, 
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
            'category_id' => $this->categoryId, // On enregistre l'ID sélectionné
            'proPhone' => $this->proPhone,
            'jobTitle' => $this->jobTitle,
            'affectation' => $this->affectation,
        ]);

        session()->flash('success', 'Agent modifié avec succès');
        return redirect()->route('employee.index');
    }

    public function mount($id)
    {
        $employee = Employee::with('category')->findOrFail($id);
        
        $this->employeeId = $employee->id;
        $this->firstName = $employee->firstName;
        $this->middleName = $employee->middleName;
        $this->lastName = $employee->lastName;
        $this->gender = $employee->gender instanceof GenderEnum 
                    ? $employee->gender->value 
                    : $employee->gender;
        $this->birthDate = $employee->birthDate ? $employee->birthDate->format('Y-m-d') : null;

        $this->birthTown = $employee->birthTown;
        $this->phone = $employee->phone;
        $this->emergencyPhone = $employee->emergencyPhone;
        $this->mail = $employee->mail;
        $this->address = $employee->address;
        $this->nationalite = $employee->nationality;
        $this->proPhone = $employee->proPhone;
        $this->proMail = $employee->proMail;
        $this->jobTitle = $employee->jobTitle;
        $this->affectation = $employee->affectation;
        $this->categoryName = (string) $employee->category->nameCategory;
        $this->categoryId = (string) $employee->category->id;
        $this->selectCategory = Category::all();
    }

    // Utilisé par le Blade pour générer les options
    public function getGendersProperty()
    {
        return GenderEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-update');
    }
}