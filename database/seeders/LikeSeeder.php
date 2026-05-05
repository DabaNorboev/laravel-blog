<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id');
        $posts = Post::pluck('id');
        $comments = Comment::pluck('id');

        $map = Relation::morphMap();

        $postType = array_search(Post::class, $map) ?: Post::class;
        $commentType = array_search(Comment::class, $map) ?: Comment::class;

        $target = 2000;

        do {
            $before = Like::count();

            $batch = collect();

            while ($batch->count() < 3000) {
                $userId = $users->random();

                if (fake()->boolean()) {
                    $type = $postType;
                    $likeableId = $posts->random();
                } else {
                    $type = $commentType;
                    $likeableId = $comments->random();
                }

                $created = fake()->dateTimeBetween('-3 months', 'now');

                $item = [
                    'user_id' => $userId,
                    'likeable_type' => $type,
                    'likeable_id' => $likeableId,
                    'created_at' => $created,
                    'updated_at' => fake()->dateTimeBetween($created, 'now'),
                ];

                $key = $userId . '-' . $type . '-' . $likeableId;

                // устранение дубликатов
                if (! $batch->has($key)) {
                    $batch->put($key, $item);
                }
            }

            Like::upsert(
                $batch->values()->toArray(),
                ['user_id', 'likeable_id', 'likeable_type'],
                []
            );

            $after = Like::count();

        } while (($after - $before) < $target);
    }
}
