<?php

use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;
use App\Actions\Subscribers\CheckForWorkingGravatar;

it('can check for working gravatar', function () {
    Http::fake([
        'gravatar.com/*' => Http::response(status: 200),
    ]);

    $subscriber = Subscriber::factory()->create();

    app(CheckForWorkingGravatar::class)->check($subscriber);

    expect($subscriber->has_working_gravatar)->toBeTrue();
});
