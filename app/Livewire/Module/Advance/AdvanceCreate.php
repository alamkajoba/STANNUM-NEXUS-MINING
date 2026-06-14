<?php

namespace App\Livewire\Module\Advance;

use App\Models\Advance;
use App\Models\Employee;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('layouts.app')]
class AdvanceCreate extends Component
{
    #[Validate('required|numeric|min:0.01')]
    public $amount = 0;

    //Var for auto complete employee
    public $search = '';
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
            
            // Extract amount and convert to float
            $this->selectedEmployee = [
                'id' => $enrollment->id,
                'baseSalary' => $enrollment->functionType->amount->getAmount()->toFloat(),
                'dayPay' => $enrollment->functionType->dayAmount->getAmount()->toFloat(),
                'hourPay' => $enrollment->functionType->hourAmount->getAmount()->toFloat(),
            ]; 

            // reset totals if needed
            $this->baseSalary = $this->selectedEmployee['baseSalary'];
            
            // close 
            $this->itemsEmployee = [];
        }
    }

    public function submitAdvance()
    {
        $employee = Employee::findOrFail($this->employee_id);

        // Check for an active advance (toRefund > 0)
        $active = Advance::where('employee_id', $this->employee_id)
                         ->where('toRefund', '>', 0)
                         ->exists();

        if ($active) {
            session()->flash('danger', $this->search." a déjà une avance en cours, voir la liste des avances.");
            return redirect()->route('advance.create');
        }

        $id = Auth::id();
        Advance::create([
            'employee_id' => $this->employee_id, 
            'amount' => $this->amount, 
            'toRefund' => $this->amount, 
            'user_id' => $id
        ]);
        session()->flash('success', $this->search." a pris une avance sur salaire de :".$this->amount."$");
        return redirect()->route('advance.create');
    }

    public function render()
    {
        return view('livewire.module.advance.advance-create');
    }
}
