<?php

namespace App\Livewire\Module\Payment;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Url;
use App\Models\Payment;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class PaymentIndex extends Component
{   
    
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    #[Url(as: 'q')]
    public ?string $search = '';

    public function render()
    {

        $payment = Payment::with(['employee.enrollment']);
        return view('livewire.module.payment.payment-index', [
            'payment' => $payment->latest()->paginate(5),
        ]);
    }
}
