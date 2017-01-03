<?php

namespace App\Listeners;

use App\Events\UsersEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailListener
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
     * @param  UsersEvent  $event
     * @return void
     */
    public function handle(UsersEvent $event)
    {
        //
        $user = $event->user;
        $confirm_code = [];
        $confirm_code['confirm_code'] = $user->confirm_code;
        $subject = 'Confirm Your Email';
        $view = 'email.register';
        \Mail::queue($view,$confirm_code,function($message) use ($user,$subject){

            $message->to($user->email)->subject($subject);

        });
    }
}
