<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Carbon\Carbon;

class AvailablePayNotify extends Notification
{
    use Queueable;

    public $motif;

    public function __construct($motif)
    {
        $this->motif = $motif;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $nomMois = Carbon::parse($this->motif)->translatedFormat('F Y');

        return (new MailMessage)
            ->from('info@alvinebusiness.com', 'Alvine Business Finance')
            ->subject("Notification de Paie - $nomMois")
            ->greeting("Bonjour Mr/Mm " . $notifiable->middleName ." ". $notifiable->lastName . " ". $notifiable->firstName . ",")
            ->line("Nous vous informons que les bulletins de paie pour le mois de **" . $nomMois . "** sont prêts.")
            ->line("Vous êtes prié(e) de passer au bureau de la Direction Financière pour récupérer votre exemplaire physique et signer le registre de paie.")
            ->line("Le bureau est ouvert du lundi au vendredi, de 08h00 à 16h00.")
            ->salutation("La Direction Financière, STANNUM NEXUS MINING SARL.");
    }
}
