<?php

namespace Database\Seeders;

use App\Events\Comment\CommentPostedEvent;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = Comment::factory(777)->create();
        $comments->each(function ($comment) {
            event(new CommentPostedEvent($comment));
        });
    }
}
