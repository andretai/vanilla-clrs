<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateCountLogin
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
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        if($event->user->count_login < 3){
            $event->user->count_login++;
            $event->user->check_guidelines = true;
            $event->user->save();
        }else{
            $event->user->count_login++;
            $event->user->save();
        }
        
    }
}
