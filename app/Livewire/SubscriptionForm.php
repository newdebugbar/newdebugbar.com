<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use App\Notifications\Subscribers\Confirm;

class SubscriptionForm extends Component
{
    #[Validate('required|email|unique:subscribers,email')]
    public string $email = '';

    #[Locked]
    public bool $subscribed = false;

    public function submit() : void
    {
        if ($this->subscribed) {
            return;
        }

        $this->validate();

        $subscriber = Subscriber::create(['email' => $this->email]);

        $subscriber->notify(new Confirm);

        $this->reset();

        $this->dispatch('notify', [
            'type' => 'info',
            'message' => "Almost there! Something's waiting in your inbox.",
        ]);

        $this->subscribed = true;
    }
}
