<?php

use App\Models\User;
use App\Models\Subscriber;

use function Pest\Laravel\get;

use Illuminate\Routing\UrlGenerator;
use App\Notifications\Subscribers\Fresh;
use Illuminate\Support\Facades\Notification;
use Facades\App\Actions\Subscribers\CheckForWorkingGravatar;

it('confirms an unverified subscriber and checks for a working gravatar', function () {
    CheckForWorkingGravatar::shouldReceive('check')->once();

    Notification::fake();

    $admin = User::factory()->create([
        'email' => 'hello@benjamincrozat.com',
    ]);

    $subscriber = Subscriber::factory()->create([
        'email_verified_at' => null,
    ]);

    get(app(UrlGenerator::class)->signedRoute('confirm-subscriber', $subscriber))
        ->assertRedirect(route('home'))
        ->assertSessionHas('notification.type', 'success')
        ->assertSessionHas('notification.message', 'Thank you! Watch your inbox for news very soon!');

    expect($subscriber->fresh()->email_verified_at)->not->toBeNull();

    Notification::assertSentTo($admin, Fresh::class);
});

it("handles already verified subscribers and doesn't check for a working gravatar", function () {
    CheckForWorkingGravatar::shouldReceive('check')->never();

    Notification::fake();

    $subscriber = Subscriber::factory()->create(['email_verified_at' => now()]);

    get(app(UrlGenerator::class)->signedRoute('confirm-subscriber', $subscriber))
        ->assertRedirect(route('home'))
        ->assertSessionHas('notification.type', 'success')
        ->assertSessionHas('notification.message', 'No worries, you already confirmed your email.');

    Notification::assertNothingSent();
});

it('rejects invalid or missing signatures', function () {
    $subscriber = Subscriber::factory()->create();

    get(route('confirm-subscriber', [$subscriber, 'signature' => 'foo']))
        ->assertForbidden();

    get(route('confirm-subscriber', $subscriber))
        ->assertForbidden();
});
