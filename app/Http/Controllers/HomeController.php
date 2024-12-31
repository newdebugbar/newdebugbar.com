<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Subscriber;

class HomeController extends Controller
{
    public function __invoke() : View
    {
        return view('home', [
            'subscribersCount' => Subscriber::count(),
            'subscribersGravatarsHashes' => Subscriber::verified()
                ->withWorkingGravatar()
                ->inRandomOrder()
                ->limit(10)
                ->pluck('gravatar_hash'),
        ]);
    }
}
