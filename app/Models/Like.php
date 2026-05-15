<?php

namespace App\Models;

use App\Events\Like\CommentLikedEvent;
use App\Events\Like\PostLikedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected static function booted(): void
    {
        static::created(function (Like $like) {
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

    public function likeable()
    {
        return $this->morphTo();
    }
}
