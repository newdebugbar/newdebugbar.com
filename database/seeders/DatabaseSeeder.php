<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run() : void
    {
        User::factory()->create([
            'name' => 'Benjamin Crozat',
            'email' => 'hello@benjamincrozat.com',
        ]);

        Subscriber::factory(random_int(100, 200))->create();
    }
}
