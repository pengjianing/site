<?php

namespace App\Listeners;

use App\Events\AddDiscussions;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class AddDiscussionsListener
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
     * @param  AddDiscussions  $event
     * @return void
     */
    public function handle(AddDiscussions $event)
    {
        //事件的监听器
        $discussion = $event->discussion;
        Cache::forget('discussions');
    }
}
