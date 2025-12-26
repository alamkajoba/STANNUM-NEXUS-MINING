<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Deduction;
use App\Models\Advance;
use App\Models\Category;
use App\Enums\MonthEnum;
use App\Models\Payment;


#[Layout('layouts.app')]
class PaymentCreate extends Component
{

    //Validate
    #[Validate('required')]
    public $employee_id = '';
    #[Validate('required')]
    public $motif = '';
    #[Validate('required')]
    public $restDay = 0;
    #[Validate('nullable')]
    public $overtimes = 0.00; 
    #[Validate('nullable')]
    public $assudityBonus = 0.00; 
    #[Validate('nullable')]
    public $riskBonus = 0.00; 
    #[Validate('nullable')]
    public $performanceBonus = 0.00; 


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

    

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
