<?php

namespace App\Listeners\Notify;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyNewFollowerListener extends BaseNotifyListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $follower = $event->follower;
        $fromUserId = $follower->follower_id;

        $toUserId = $follower->following_id;

        if ($fromUserId == $toUserId) {
            return;
        }

        $this->createNotification($toUserId, $fromUserId, $follower, 'user_followed');
    }
}
