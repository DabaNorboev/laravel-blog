<?php

namespace Database\Seeders;

use App\Events\User\UserFollowedEvent;
use App\Models\Follower;
use Illuminate\Database\Seeder;

class FollowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $followers = Follower::factory(500)->create();
        $followers->each(function ($follower) {
           event(new UserFollowedEvent($follower));
        });
    }
}
