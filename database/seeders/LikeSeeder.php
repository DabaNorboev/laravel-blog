<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        $likes = Like::factory(2000)
            ->recycle($users)
            ->recycle($posts)
            ->recycle($comments)
            ->make()
            ->unique(fn ($like) => $like->user_id.$like->likeable_id.$like->likeable_type);

        Like::insert($likes->toArray());

    }
}
