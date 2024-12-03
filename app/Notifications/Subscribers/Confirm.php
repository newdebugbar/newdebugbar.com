<?php

namespace App\Notifications\Subscribers;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Confirm extends Notification
{
    use Queueable;

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable) : array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable) : MailMessage
    {
        return (new MailMessage)
            ->subject('Are you a bot?')
            ->greeting('Thanks for your interest!')
            ->line('If you want to receive updates, please confirm that you are not a bot by clicking the button below.')
            ->action('Beep boop… I am not a bot', url('/'))
            ->line('See you later!');
    }
}
