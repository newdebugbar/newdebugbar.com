<?php

namespace App\Notifications\Subscribers;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Confirm extends Notification
{
    use Queueable;

    /**
     * @return array<int, string>
     */
    public function via(Subscriber $subscriber) : array
    {
        return ['mail'];
    }

    public function toMail(Subscriber $subscriber) : MailMessage
    {
        return (new MailMessage)
            ->subject('Are you a bot?')
            ->greeting('Thanks for your interest!')
            ->line('If you want to receive updates, please confirm that you are not a bot by clicking the button below.')
            ->action('Beep boop… I am not a bot', app(UrlGenerator::class)->signedRoute('confirm-subscriber', $subscriber))
            ->line('See you later!');
    }
}
