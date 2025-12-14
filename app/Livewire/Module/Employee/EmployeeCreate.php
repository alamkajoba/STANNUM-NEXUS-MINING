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

    public $convertFirstName;
    public $convertMiddleName;
    public $convertLastName;

    public $selectCategory;


    #[Validate('required|min:3|max:30|regex:/^\S+$/')]
    public $firstName = '';

    #[Validate('required|min:3|max:30|regex:/^\S+$/')]
    public $middleName = '';

    #[Validate('required|min:3|max:30|regex:/^\S+$/')]
    public $lastName = '';

    #[Validate('required')]
    public $gender = '';

    #[Validate('required|date|before_or_equal:today')]
    public $birthDate = '';

    #[Validate('required|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $birthTown = '';

    #[Validate('required|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $matricule = '';

    #[Validate('required')]
    public $category = '';

    #[Validate('required|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $address = '';

    #[Validate('nullable|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $mail = '';

    #[Validate('required|regex:/^[0-9\s\-\+\(\)]+$/|min:8|max:20')]
    public $phone = '';


    private function dataEmployee(): array
    {
        $id = Auth::id();
        return [
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'gender' => $this->gender,
            'birthDate' => $this->birthDate,
            'birthTown' => $this->birthTown,
            'matricule' => $this->matricule,
            'category_id' => $this->category,
            'mail' => $this->mail,
            'address' => $this->address,
            'phone' => $this->phone,
            'user_id' => $id
        ];
    }

    public function submitEmployee()
    {
        $this->validate();

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
            session()->flash('danger', "Cet agent existe déjà!...");
            return redirect()->route('employee.create');
        }

        $employee = Employee::create($this->dataEmployee());
        session()->flash('success', "L'Agent a été créé avec succès.");
        return redirect()->to(route('employee.index'));
    }

    // Gender Enum
    private function gender(): array
    {
        return GenderEnum::cases();
    }

    public function mount()
    {
        $this->selectCategory = Category::all();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-create');
    }
}
