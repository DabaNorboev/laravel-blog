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

    protected static function booted()
    {
        static::created(function ($like) {
            $likeableType = $like->likeable_type;

            if ($likeableType === 'post') {
                event(new PostLikedEvent($like));
            } elseif ($likeableType === 'comment') {
                event(new CommentLikedEvent($like));
            }
        });
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
