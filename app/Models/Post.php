<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use softDeletes;
    use HasFactory;

    protected $table = 'posts';

    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id', 'category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
