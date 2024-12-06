<?php

namespace App\Notifications\Subscribers;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Fresh extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Subscriber $subscriber,
    ) {}

    /**
     * @return array<int, string>
     */
    public function via() : array
    {
        return ['mail'];
    }

    public function toMail() : MailMessage
    {
        return (new MailMessage)
            ->subject('New subscriber')
            ->greeting('Good news!')
            ->line("**{$this->subscriber->email}** is one more person interested in the new debug bar!");
    }
}
