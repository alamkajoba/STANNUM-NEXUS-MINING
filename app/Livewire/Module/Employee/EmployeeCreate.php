<?php

namespace App\Livewire\Module\Employee;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Employee;
use App\Enums\GenderEnum;
use Livewire\Attributes\Validate;
use App\Models\FunctionType;
use App\Enums\EchelonEnum;
use App\Enums\CategoryProfEnum;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.app')]
class EmployeeCreate extends Component
{

    public $convertMiddleName;
    public $convertLastName;
    public $convertFirstName;
    public $functionType;
    public $step = 1;
    public $totalSteps = 4;

    // Étape 1 : État Civil
    public $middleName, $lastName, $firstName, $gender, $birthDate, $birthTown;
    
    // Étape 2 : Contacts & Adresse
    public $phone, $emergencyPhone, $mail, $nationality, $address;
    
    // Étape 3 : Infos Pro
    public $site, $section, $functionName, $startDate, $department, $professionalCategory, $echelon;
    
    // Étape 4 : Infos Bancaires & Sociales
    public $proMail, $proPhone, $acountNumber, $cnssNumber;


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

    public function generateNextMatricule($employee)
    {
        return 'SNM' . str_pad($employee, 3, '0', STR_PAD_LEFT);
    }

    public function saveEmployee()
    {

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
            session()->flash('danger', "agent ".$this->middleName." ".$this->lastName." ".$this->firstName." existe déjà!...");
            return;
        }

        // Logique d'enregistrement
        try {
            $userId = Auth::id();

            DB::beginTransaction();
            $employee = Employee::create([
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

            Enrollment::create([
                'section' => $this->section, 
                'department' => $this->department, 
                'site' => $this->site, 
                'professionalCategory' => $this->professionalCategory,
                'echelon' => $this->echelon, 
                'matricule' => $this->generateNextMatricule($employee->id),
                'startDate' => $this->startDate,
                'proMail' => $this->proMail, 
                'proPhone' => $this->proPhone, 
                'employee_id' => $employee->id, 
                'function_type_id' => $this->functionName,
                'acountNumber' => $this->acountNumber,
                'cnssNumber' => $this->cnssNumber
            ]);
            DB::commit();

            session()->flash('success', 'Agent enregistré avec succès !');
            return redirect()->route('employee.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash("danger", "Une erreur est survenue lors de l'enregistrement.");
            dd([
                'Message' => $e->getMessage(),
                'Fichier' => $e->getFile(),
                'Ligne'   => $e->getLine(),
            ]);
        }
    }
    
    public function mount()
    {
        $this->functionType = FunctionType::all();
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
        return view('livewire.module.employee.employee-create');
    }
}
