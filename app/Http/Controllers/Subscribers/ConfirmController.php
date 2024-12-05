<?php

namespace App\Http\Controllers\Subscribers;

use App\Models\User;
use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Notifications\Subscribers\Fresh;

class ConfirmController extends Controller
{
    public function __invoke(Subscriber $subscriber) : RedirectResponse
    {
        if ($subscriber->email_verified_at) {
            return to_route('home')->with('notification', [
                'type' => 'success',
                'message' => 'No worries, you already confirmed your email.',
            ]);
        }

        $subscriber->update(['email_verified_at' => now()]);

        User::query()
            ->where('email', 'hello@benjamincrozat.com')
            ->first()
            ?->notify(new Fresh($subscriber));

        return to_route('home')->with('notification', [
            'type' => 'success',
            'message' => 'Thank you! Watch your inbox for news very soon!',
        ]);
    }
}
