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
    #[Validate('nullable')]
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
    public $employeeId;

    public $category_id;

    //Bonus
    public $brutWithoutDeduction = 0.00;

    //Avantage
    public $brutWiAfterDeduction = 0.00;


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
        //Select category
        $category = Category::find($this->category_id);

        $overtimesPay = $this->overtimes * $category->hourAmount;
        $absence = $this->restDay * $category->dayAmount;

        //brut without deduction
        $this->brutWithoutDeduction = $this->riskBonus + 
                    $this->performanceBonus + 
                    $this->assudityBonus + 
                    $category->housing + 
                    $category->transportationCost + 
                    $category->amount +
                    $category->familialAllocation + 
                    $overtimesPay - 
                    $absence;
        

        //Select deduction
        $deduction = Deduction::first();
        $IPR =  $category->amount *  ($deduction->IPR /100);
        $CNSS =  $category->amount *  ($deduction->CNSS /100);
        $ONEM =  $category->amount *  ($deduction->ONEM /100);
        $INPP =  $category->amount *  ($deduction->INPP /100);
        $deductionSalary =  $category->amount *  ($deduction->deductionSalary /100);
        $totalCCC = ($IPR + $INPP + $ONEM + $CNSS + $deductionSalary);
        dd($totalCCC);

        $this->brutWiAfterDeduction = $this->brutWithoutDeduction - ($IPR + $INPP + $ONEM + $CNSS + $deductionSalary);
        

        //Select advance
        $advance = Advance::find($this->employee_id);
        if($advance)
        {
            $remainToRefundAdvance = $advance->toRefund;
            $totalCredit = $advance->amount;
            //Make deduction if remaining advance is over refund amount
            if($remainToRefundAdvance >= $toRefundAdvance)
            {
                $this->brutWiAfterDeduction = $brutWiAfterDeduction - $toRefundAdvance;
            }

            //Make deduction if remaining advance is over refund amount
            elseif($remainToRefundAdvance < $toRefundAdvance)
            {
                $this->brutWiAfterDeduction = $brutWiAfterDeduction - $remainToRefundAdvance;
                $toRefundAdvance = $remainToRefundAdvance;
            }
        }
        
        //Submit payment
        $check = Payment::where('employee_id', $this->employee_id)
                        ->where('motif', $this->motif)
                        ->exists();
        if ($check) {
            session()->flash('danger', $this->search." a déjà eu le salaire : ".$this->motif );
            return redirect()->route('payment.create');
        }

        $id = Auth::id();
        Payment::create([
            'employee_id' => $this->employee_id, 
            'motif' => $this->motif, 
            'totalAmount' => $this->brutWithoutDeduction,  
            'netAmount' => $this->brutWiAfterDeduction,  
            'restDay' => $this->restDay, 
            'overtimesPay' => $overtimesPay, 
            'overtimes' => $this->overtimes,
            'assudityBonus' => $this->assudityBonus, 
            'riskBonus' => $this->riskBonus,
            'performanceBonus' => $this->performanceBonus, 
            'CNSS'=> $deduction->CNSS, 
            'INPP'=> $deduction->INPP, 
            'ONEM'=> $deduction->ONEM,   
            'IPR'=> $deduction->IPR,  
            'refundAdvanceAmount' => $deduction->refundAdvanceAmount,   
            'deductionSalary'=> $deduction->deductionSalary,  
            'user_id' => $id
        ]);

        if($advance)
        {
            $remain = $advance->toRefund - $toRefundAdvance;
            if($remain == 0)
            {
                $advance->delete();

                session()->flash('success', "Paiement effectué pour :".$this->search." Motif : ".$this->motif );
                return redirect()->route('payment.create');
            }

            $advance->update([
                'toRefund' => $advance->toRefund - $toRefundAdvance,
            ]);
        }
        $print = Payment::latest()->first();
        session()->flash('success', "Paiement effectué pour :".$this->search." Motif : ".$this->motif );
        return redirect()->route('payment.print', $print->id);
    }

    // Gender Enum
    private function month(): array
    {
        return MonthEnum::cases();
    }

    public function render()
    {
        return view('livewire.module.payment.payment-create');
    }
}
