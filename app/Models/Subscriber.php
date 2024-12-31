<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscriber extends Model
{
    /** @use HasFactory<\Database\Factories\SubscriberFactory> */
    use HasFactory, Notifiable;

    public function scopeVerified(Builder $query) : void
    {
        $query->whereNotNull('email_verified_at');
    }

    public function scopeWithWorkingGravatar(Builder $query) : void
    {
        $query
            ->whereNotNull('gravatar_hash')
            ->where('has_working_gravatar', true);
    }

    public function markAsVerified() : void
    {
        $this->update([
            'email_verified_at' => now(),
        ]);
    }

    public function saveNewGravatarHash() : void
    {
        $this->update([
            'gravatar_hash' => $this->generateGravatarHash(),
        ]);
    }

    public function generateGravatarHash() : string
    {
        return hash('sha256', $this->email);
    }

    public function markGravatarAsWorking() : void
    {
        $this->update([
            'has_working_gravatar' => true,
        ]);
    }
}
