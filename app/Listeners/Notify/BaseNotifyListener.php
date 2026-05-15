<?php

namespace App\Listeners\Notify;

use App\Models\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

abstract class BaseNotifyListener implements ShouldQueue
{
    use InteractsWithQueue;

    public string $queue = 'notifications';
    public int $tries = 3;
    public bool $deleteWhenMissingModel = true;
    public function backoff(): array
    {
        return [1, 5, 10];
    }
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
