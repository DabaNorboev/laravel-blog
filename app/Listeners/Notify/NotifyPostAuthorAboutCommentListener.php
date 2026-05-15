<?php

namespace App\Listeners\Notify;

use App\Models\Notification;

class NotifyPostAuthorAboutCommentListener extends BaseNotifyListener
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
        $comment = $event->comment;
        $fromUserId = $comment->user_id;

        $post = $comment->post;
        $toUserId = $post->user_id;

        if ($fromUserId === $toUserId) {
            return;
        }

        $data = [
            'post_id' => $post->id,
            'post_title' => $post->title,
            'comment_text' => $comment->message,
        ];

        $this->createNotification($toUserId, $fromUserId, $post, 'comment_posted', $data);
    }
}
