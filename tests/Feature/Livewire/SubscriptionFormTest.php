<?php

use App\Livewire\SubscriptionForm;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(SubscriptionForm::class)
        ->assertStatus(200);
});
