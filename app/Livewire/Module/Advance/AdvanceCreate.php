<?php

namespace App\Livewire\Module\Advance;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use App\Models\Advance;

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
        $this->employee_id = $this->selectedEmployee['id'];
        $this->category_id = $this->selectedEmployee['category_id'];
        $this->itemsEmployee = []; // Vide les suggestions

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

        // Limit: e.g., max 50% of base salary
        $max = $employee->category->amount;
        if ($this->amount > $max) {
            session()->flash('danger', 'Le montant dépasse le plafond autorisé (50% du salaire)');
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
