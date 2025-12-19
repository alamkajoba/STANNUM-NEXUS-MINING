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

    public $categoryName = '';

    #[Validate('required|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $address = '';

    #[Validate('nullable|min:3|max:100|regex:/^[\pL\pN\s,\.\-#\/]+$/u')]
    public $mail = '';

    #[Validate('required|regex:/^[0-9\s\-\+\(\)]+$/|min:8|max:20')]
    public $phone = '';

    public $employeeId;

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
            'category_id' => $this->categoryName,
            'mail' => $this->mail,
            'address' => $this->address,
            'phone' => $this->phone,
            'user_id' => $id
        ];
    }

    public function updateEmployee()
    {
        $this->validate();

        $employee = Employee::find($this->employeeId);
        $employee->update($this->dataEmployee());
        session()->flash('success', "L'Agent:".$this->firstName."_".$this->middleName." a été modifié avec succès.");
        return redirect()->to(route('employee.index'));
    }
    

    public function mount($id)
    {

        $updateEmloyee = Employee::find($id);
        $updateCategory = Category::find($updateEmloyee->category_id);

        $this->sub = $updateEmloyee->id;
        $this->firstName = $updateEmloyee->firstName;
        $this->middleName = $updateEmloyee->middleName;
        $this->lastName = $updateEmloyee->lastName;
        $this->gender = $updateEmloyee->gender;
        $this->birthDate = $updateEmloyee->birthDate;
        $this->birthTown = $updateEmloyee->birthTown;
        $this->address = $updateEmloyee->address;
        $this->matricule = $updateEmloyee->matricule;
        $this->categoryName = $updateCategory->nameCategory;
        $this->phone = $updateEmloyee->phone;
        $this->mail = $updateEmloyee->mail;
        $this->employeeId = $updateEmloyee->id;

        $this->selectCategory = Category::all();
        
    }

    // Gender Enum
    private function gender(): array
    {
        return GenderEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.employee.employee-update');
    }
}
