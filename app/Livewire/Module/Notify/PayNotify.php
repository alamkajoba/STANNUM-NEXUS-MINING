<?php

namespace App\Livewire\Module\Notify;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Employee;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AvailablePayNotify;
use Illuminate\Support\Facades\Mail;


#[Layout('layouts.app')]
class PayNotify extends Component
{
    public $motif;

    public function sendMail()
    {
        // 1. Validation du mois
        $this->validate(['motif' => 'required']);

        // 2. On récupère TOUS les employés qui ont un mail renseigné
        $tousLesAgents = Employee::whereNotNull('proMail')->get();

        if ($tousLesAgents->isEmpty()) {
            session()->flash('error', "Aucun agent n'a d'adresse mail dans la base de données.");
            return;
        }

        try {
            // 3. Send to all employees 
            Notification::send($tousLesAgents, new AvailablePayNotify($this->motif));

            // 2. One copy for the office
            // Mail::raw("L'envoi des notifications de paie pour {$this->motif} a été effectué avec succès pour {$agents->count()} agents.", function ($message) {
            //     $message->to('info@alvinebusiness.com') //admin acount
            //             ->subject("Rapport d'envoi - Alvine Business");
            // });

           
        } catch (\Exception $e) {
            session()->flash('danger', "Erreur SMTP Hostinger : " . $e->getMessage());
        }
        session()->flash('success', "La notification a été envoyée avec succès à " . $tousLesAgents->count() . " agents.");
        return redirect()->route('payment.payNotify');
    }




    public function render()
    {
        return view('livewire.module.notify.pay-notify');
    }
}
