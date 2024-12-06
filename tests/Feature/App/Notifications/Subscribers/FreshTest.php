<?php

use App\Models\Subscriber;
use App\Notifications\Subscribers\Fresh;
use Illuminate\Notifications\Messages\MailMessage;

it('uses the mail channel', function () {
    $subscriber = Subscriber::factory()->create();

    expect((new Fresh($subscriber))->via())->toBe(['mail']);
});

it('builds the email correctly', function () {
    $subscriber = Subscriber::factory()->create([
        'email' => 'test@example.com',
    ]);

    $mail = (new Fresh($subscriber))->toMail();

    expect($mail)->toBeInstanceOf(MailMessage::class);
    expect($mail->subject)->toBe('New subscriber');
    expect($mail->greeting)->toBe('Good news!');
    expect($mail->introLines)->toMatchArray([
        '**test@example.com** is one more person interested in the new debug bar!',
    ]);
});
