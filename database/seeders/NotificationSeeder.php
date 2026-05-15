<?php

namespace Database\Seeders;

use App\Events\Like\CommentLikedEvent;
use App\Events\Like\PostLikedEvent;
use App\Models\Like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Like::all()->each(function (Like $like) {
            $eventMap = [
                'post'    => PostLikedEvent::class,
                'comment' => CommentLikedEvent::class,
            ];

            $eventClass = $eventMap[$like->likeable_type] ?? null;

            if ($eventClass) {
                event(new $eventClass($like));
            }
        });
    }
}
