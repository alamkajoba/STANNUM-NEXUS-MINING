<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use App\Models\Category;
use App\Enums\GenderEnum;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\FunctionType;
use App\Models\Enrollment;
use App\Enums\EchelonEnum;
use App\Enums\CategoryProfEnum;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]

class EmployeeUpdate extends Component
{
    public $step = 1;
    public $totalSteps = 4;
    public $employeeId;
    public $employee;
    public $enrollment;

    // Étape 1 : État Civil
    public $emploee_id, $middleName, $lastName, $firstName, $gender, $birthDate, $birthTown;
    
    // Étape 2 : Contacts & Adresse
    public $phone, $emergencyPhone, $mail, $nationality, $address;
    
    // Étape 3 : Infos Pro
    public $enrollment_id, $site, $section, $functionName, $startDate, $department, $professionalCategory, $echelon;
    
    // Étape 4 : Infos Bancaires & Sociales
    public $proMail, $proPhone, $acountNumber, $cnssNumber;
    
    // Liste pour les selects
    public $functionType;

    public function nextStep()
    {
        $this->validateData();
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function validateData()
    {
        if ($this->step == 1) {
            $this->validate([
                'middleName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'lastName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'firstName' => 'required|string|regex:/^[a-zA-Z\s\-]+$/',
                'gender' => 'required|in:homme,femme',
                'birthDate' => 'required|date',
                'birthTown' => 'required',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'phone' => 'required',
                'emergencyPhone' => 'nullable',
                'mail' => 'nullable|email',
                'nationality' => 'required',
                'address' => 'required',
            ]);
        } elseif ($this->step == 3) {
            $this->validate([
                'site' => 'required',
                'section' => 'required',
                'echelon' => 'required',
                'functionName' => 'required',
                'professionalCategory' => 'required',
                'department' => 'required',
                'startDate' => 'required|date',
            ]);
        } elseif ($this->step == 4) {
            $this->validate([
                'proMail' => 'nullable|email',
                'proPhone' => 'nullable|numeric|digits_between:9,15',
                'acountNumber' => 'nullable',
                'cnssNumber' => 'nullable|regex:/^[0-9A-Z]{10,13}$/i',
            ]);
        }
    }

    public function saveEmployee()
    {

        // Logique d'enregistrement
        try {
            $userId = Auth::id();

            DB::beginTransaction();
            $this->employee->update([
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
                'nationality' => $this->nationality,
                'user_id' => $userId,
            ]);

            $this->enrollment->update([
                'section' => $this->section, 
                'department' => $this->department, 
                'site' => $this->site, 
                'professionalCategory' => $this->professionalCategory,
                'echelon' => $this->echelon, 
                'startDate' => $this->startDate,
                'proMail' => $this->proMail, 
                'proPhone' => $this->proPhone, 
                'employee_id' => $this->employee->id, 
                'function_type_id' => $this->functionName,
                'acountNumber' => $this->acountNumber,
                'cnssNumber' => $this->cnssNumber
            ]);
            DB::commit();

            session()->flash('success', 'Agent a été modifié avec succès !');
            return redirect()->route('employee.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("danger", "Une erreur est survenue lors de la modification.");
            dd([
                'Message' => $e->getMessage(),
                'Fichier' => $e->getFile(),
                'Ligne'   => $e->getLine(),
            ]);
        }
    }
    
    public function mount($id)
    {
        $this->functionType = FunctionType::all();
        $this->employee = Employee::findOrFail($id);
        $this->emploee_id = $this->employee->id;
        $this->middleName = $this->employee->middleName;
        $this->lastName = $this->employee->lastName;
        $this->firstName = $this->employee->firstName;
        $this->gender = $this->employee->gender;
        $this->birthDate = $this->employee->birthDate?->format('Y-m-d');
        $this->birthTown = $this->employee->birthTown;
        $this->phone = $this->employee->phone;
        $this->emergencyPhone = $this->employee->emergencyPhone;
        $this->nationality = $this->employee->nationality;
        $this->mail = $this->employee->mail;
        $this->address = $this->employee->address;

        $this->enrollment = Enrollment::where('employee_id', $this->emploee_id)->first();
        $this->enrollment_id = $this->enrollment->id;
        $this->site = $this->enrollment->site;
        $this->section = $this->enrollment->section;
        $this->functionName = $this->enrollment->function_type_id;
        $this->startDate = $this->enrollment->startDate?->format('Y-m-d');
        $this->department = $this->enrollment->department;
        $this->professionalCategory = $this->enrollment->professionalCategory;
        $this->echelon = $this->enrollment->echelon;
        $this->proMail = $this->enrollment->proMail;
        $this->proPhone = $this->enrollment->proPhone;
        $this->acountNumber = $this->enrollment->acountNumber;
        $this->cnssNumber = $this->enrollment->cnssNumber;
        
    }

    //Enums
    private function gender(): array
    {
        return GenderEnum::cases();
    }

    private function echelon(): array
    {
        return EchelonEnum::cases();
    }

    private function category(): array
    {
        return CategoryProfEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-update');
    }
}