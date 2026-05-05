<?php

namespace App\Models;

use App\Events\User\UserFollowedEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;
    protected $guarded = false;

    protected static function booted()
    {
        static::created(function ($follower) {
           event(new UserFollowedEvent($follower));
        });
    }


}
