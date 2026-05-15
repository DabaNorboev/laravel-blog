<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notification\FilterRequest;
use App\Models\Notification;
use App\Models\User;

class NotificationController extends Controller
{
    public function index(FilterRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();
        $notificationsQuery = Notification::query()->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifications.index')->with(['notifications' => $notificationsQuery]);
    }

    public function markAsRead(Notification $notification)
    {
        if (!$notification->read && $notification->user_id === auth()->id())
        {
            $notification->update([
                'read' => true,
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Уведомление отмечено как прочитанное');
    }
}
