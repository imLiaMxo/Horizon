<?php

namespace App\Listeners;

use App\Notifications\UserApplied;
use Illuminate\Contracts\Events\Dispatcher;

class UserNotificationSubscriber
{
    public function onUserApplied(UserApplied $apply)
    {
        if ($apply->user->is($apply->user)) return; // Ignore original poster.

        $apply->user->notify(
            new UserApplied($apply)
        );
    }

}