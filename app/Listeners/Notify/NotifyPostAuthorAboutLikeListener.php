<?php

namespace App\Listeners\Notify;

use Illuminate\Queue\InteractsWithQueue;

class NotifyPostAuthorAboutLikeListener extends BaseNotifyListener
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
        $like = $event->like;
        $fromUserId = $like->user_id;

        $post = $like->likeable;
        $toUserId = $post->user_id;

        if ($fromUserId === $toUserId) {
            return;
        }

        $data = [
            'post_id' => $post->id,
            'post_title' => $post->title,
        ];

        $this->createNotification($toUserId, $fromUserId, $post, 'post_liked', $data);
    }
}
