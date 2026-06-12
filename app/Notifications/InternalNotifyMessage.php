<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InternalNotifyMessage extends Notification
{
    use Queueable;

    public $message_custom;

    public function __construct($message_custom)
    {
        $this->message_custom = $message_custom;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }
    //Mail
    public function toMail($notifiable): MailMessage
    {
        $message_custom = $this->message_custom;

        return (new MailMessage)
            ->from('info@alvinebusiness.com', 'Alvine Business Finance')
            ->greeting("Bonjour Mr/Mm " . $notifiable->middleName ." ". $notifiable->lastName . " ". $notifiable->firstName . ",")
            ->line(new \Illuminate\Support\HtmlString($this->message_custom))
            ->salutation("La Direction, STANNUM NEXUS MINING SARL.");
    }
}
