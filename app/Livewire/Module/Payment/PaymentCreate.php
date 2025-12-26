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

    //Var for auto complete employee
    public $search = '';
    public $itemsEmployee = [];
    public $selectedEmployee = [null];

    //All for paySlip
    public $childCount = 0;
    public $baseSalary = 0.00;
    public $dayMounth = 0;
    public $justifyDay = 0;
    public $workDay = 0;
    //payment
    public $baseMounthlyDay = '';
    public $overtimesPay = 0.00;
    //advantage
    public $housingDay = 0.00;
    public $housingMounth = 0.00;
    public $transportationCostDay = 0.00;
    public $transportationCostMounth = 0.00;
    public $familialAllocationDay = 0.00;
    public $familialAllocationMounth = 0.00;
    public $totalAdvantage= 0.00;
    //deduction
    public $CNSS = 0.00;
    public $INPP = 0.00;
    public $ONEM = 0.00;
    public $IPR = 0.00;
    public $deductionSalary = 0.00;
    public $refund = 0.00;
    public $CNSSAmount = 0.00;
    public $INPPAmount = 0.00;
    public $ONEMAmount = 0.00;
    public $IPRAmount = 0.00;
    public $deductionSalaryAmount = 0.00;
    public $refundAmount = 0.00;
    public $totalDeduction = 0.00;
    //final
    public $brutSalary = 0.00;
    public $netSalary = 0.00;



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

    public function submitPayment()
    {
        dd($this->motif);
    }

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
