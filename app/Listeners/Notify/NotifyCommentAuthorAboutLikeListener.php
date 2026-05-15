<?php

namespace App\Listeners\Notify;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCommentAuthorAboutLikeListener extends BaseNotifyListener
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

        $comment = $like->likeable;
        $toUserId = $comment->user_id;

        if ($fromUserId === $toUserId) {
            return;
        }

        $post = $comment->post;

        $data = [
            'post_id' => $post->id,
            'post_title' => $post->title,
            'comment_text' => $comment->message,
        ];

        $this->createNotification($toUserId, $fromUserId, $comment, 'comment_liked', $data);
    }
}
