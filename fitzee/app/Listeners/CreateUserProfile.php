<?php

namespace App\Listeners;

use App\Models\Profile;
use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateUserProfile
{
    public function handle(UserCreated $event)
    {
        $event->user->profile()->create();
    }
}
