<?php

use Livewire\Livewire;
use App\Models\Subscriber;
use App\Livewire\SubscriptionForm;
use App\Notifications\Subscribers\Confirm;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;

it('allows a visitor to subscribe', function () {
    Notification::fake();

    assertDatabaseEmpty(Subscriber::class);

    Livewire::test(SubscriptionForm::class)
        ->assertSet('subscribed', false)
        ->set('email', fake()->safeEmail())
        ->call('submit')
        ->assertSet('email', '')
        ->assertSet('subscribed', true);

    assertDatabaseCount(Subscriber::class, 1);

    Notification::assertSentTo(
        Subscriber::first(),
        Confirm::class
    );
});

it('does not allow a visitor to subscribe with an invalid email', function () {
    Livewire::test(SubscriptionForm::class)
        ->set('email', 'foo')
        ->call('submit')
        ->assertHasErrors('email');
});

it('does not allow a visitor to subscribe with an already subscribed email', function () {
    Subscriber::factory()->create(['email' => 'test@example.com']);

    Livewire::test(SubscriptionForm::class)
        ->set('email', 'test@example.com')
        ->call('submit')
        ->assertHasErrors('email');
});
