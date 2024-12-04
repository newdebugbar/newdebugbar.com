<?php

namespace App\Http\Controllers\Subscribers;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ConfirmController extends Controller
{
    public function __invoke(Subscriber $subscriber) : RedirectResponse
    {
        $subscriber->update(['email_verified_at' => now()]);

        return to_route('home')->with('notification', [
            'type' => 'success',
            'message' => 'Thank you! Watch your inbox for news very soon!',
        ]);
    }
}
