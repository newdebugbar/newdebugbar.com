<?php

use App\Models\Subscriber;
use App\Notifications\Subscribers\Confirm;
use Illuminate\Notifications\Messages\MailMessage;

it('uses the mail channel', function () {
    expect((new Confirm)->via())->toBe(['mail']);
});

it('builds the email correctly', function () {
    $subscriber = Subscriber::factory()->create();

    $mail = (new Confirm)->toMail($subscriber);

    expect($mail)->toBeInstanceOf(MailMessage::class);
    expect($mail->subject)->toBe('Are you a bot?');
    expect($mail->greeting)->toBe('Thanks for your interest!');
    expect($mail->introLines)->toMatchArray(['If you want to receive updates, please confirm that you are not a bot by clicking the button below.']);
    expect($mail->outroLines)->toMatchArray(['See you later!']);
    expect($mail->actionText)->toBe('Beep bo… I am not a bot');
    expect($mail->actionUrl)->toContain(route('confirm-subscriber', [$subscriber, 'signature' => '']));
});
