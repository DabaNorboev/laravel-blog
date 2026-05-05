<?php

namespace App\Listeners\Notify;

use App\Models\Notification;

abstract class BaseNotifyListener
{
    protected function createNotification(int $toUserId, int $fromUserId, object $notifiable, string $type, ?array $data = null): void
    {
        Notification::create([
            'user_id' => $toUserId,
            'from_user_id' => $fromUserId,
            'notifiable_type' => $notifiable->getMorphClass(),
            'notifiable_id' => $notifiable->getKey(),
            'type' => $type,
            'data' => $data,
            'read' => false,
        ]);
    }
}
