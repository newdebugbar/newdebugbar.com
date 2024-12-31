<?php

namespace App\Actions\Subscribers;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Http;

class CheckForWorkingGravatar
{
    public function check(Subscriber $subscriber) : void
    {
        $hash = $subscriber->generateGravatarHash();

        $result = Http::head("https://www.gravatar.com/avatar/$hash?d=404");

        if ($result->successful()) {
            $subscriber->update([
                'gravatar_hash' => $hash,
                'has_working_gravatar' => true,
            ]);
        }
    }
}
