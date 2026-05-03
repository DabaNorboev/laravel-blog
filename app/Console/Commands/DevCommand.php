<?php

namespace App\Console\Commands;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'develop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for development automatization';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $user1 = User::create([
//            'name' => 'a',
//            'email' => 'aaaa@mail.a',
//            'password' => 'password',
//        ]);
//
//        $user2 = User::create([
//            'name' => 'a',
//            'email' => 'bbbb@mail.a',
//            'password' => 'password',
//        ]);

        $follower = Follower::create([
            'follower_id' => 1,
            'following_id' => 2,
        ]);

        dd($follower->toarray());
    }
}
