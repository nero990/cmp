<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $person = $event->person;

        $person->user()->create([
            'username'=> $person->username,
            'password' => !empty(User::$password) ? User::$password : 'password'
        ]);
    }
}
