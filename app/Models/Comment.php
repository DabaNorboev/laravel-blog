<?php

namespace App\Models;

use App\Events\Comment\CommentPostedEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $guarded = false;

    protected static function booted()
    {
        static::created(function ($comment) {
            event(new CommentPostedEvent($comment));
        });

        static::addGlobalScope('latest', function (Builder $builder) {
            $builder->latest();
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }
}
