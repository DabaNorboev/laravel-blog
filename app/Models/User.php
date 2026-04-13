<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function commentsToUserPosts()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'user_id', 'post_id');
    }

    public function likedPosts()
    {
        return $this->MorphedByMany(Post::class, 'likeable', 'likes');
    }

    public function scopeWithStats($query)
    {
        return $query->withCount([
                'posts',
                'commentsToUserPosts as posts_comments_count'
            ])
            ->withSum('posts as posts_likes_sum', 'likes')
            ->withSum('posts as posts_views_sum', 'views');
    }
}
