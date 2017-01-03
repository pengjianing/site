<?php

namespace App\Events;

use App\Discussion;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AddDiscussions extends Event
{
    use SerializesModels;
    public $discussion;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        //
        $this->discussion = $discussion;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
