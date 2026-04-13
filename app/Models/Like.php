<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = false;

    protected static function booted()
    {
        static::created(function ($like) {
            $like->likeable()->increment('likes');
        });
        static::deleted(function ($like) {
            $like->likeable()->decrement('likes');
        });
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
