<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    public function postsLikes()
    {
        return $this->hasManyThrough(Like::class, Post::class, 'user_id', 'likeable_id')
            ->where('likes.likeable_type', (new Post)->getMorphClass());
    }


    public function postsComments()
    {
        return $this->hasManyThrough(Comment::class, Post::class, 'user_id', 'post_id');
    }
    public function likes()
    {
        return $this->morphedByMany(Post::class, 'likeable', 'likes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }


    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }

    public function isFollowed(User $following): bool
    {
        return $this->followings()->where('following_id', $following->id)->exists();
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%");
    }
    public function scopeOnlyAuthor($query)
    {
        return $query->has('posts');
    }
    public function scopeStats($query)
    {
        return $query->withCount(['posts', 'postsComments', 'postsLikes','comments', 'likes', 'followings', 'followers'])
            ->withSum('posts','views');
    }
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['is_author'] ?? false, fn($q) => $q->has('posts'))
            ->when($filters['search'] ?? null, fn($q) => $q->where('name', 'like', "%{$filters['search']}%"));
    }

    public function scopeSort($query, array $filters)
    {
        $column = match($filters['sort_column'] ?? 'likes') {
            'views'    => 'posts_sum_views',
            'posts'    => 'posts_count',
            'comments' => 'posts_comments_count',
            default    => 'posts_likes_count', // 'likes' и всё остальное
        };

        $direction = ($filters['sort_direction'] ?? 'desc') === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($column, $direction)->orderBy('id', 'desc');
    }
}
