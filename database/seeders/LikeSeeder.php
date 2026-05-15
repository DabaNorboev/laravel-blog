<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users    = User::pluck('id');
        $posts    = Post::pluck('id');
        $comments = Comment::pluck('id');

        $likeables = [
            (new Post())->getMorphClass()    => $posts,
            (new Comment())->getMorphClass() => $comments,
        ];

        $this->seedLikes($users, $likeables, targetCount: 200);
    }

    private function seedLikes(Collection $users, array $likeables, int $targetCount): void
    {
        $existing = collect();

        while ($existing->count() < $targetCount) {
            $remaining = $targetCount - $existing->count();
            $batch     = $this->generateBatch($users, $likeables, $remaining, $existing);

            Like::upsert(
                $batch->values()->toArray(),
                ['user_id', 'likeable_id', 'likeable_type'],
            );

            $existing = $existing->merge($batch->keys());
        }
    }

    private function generateBatch(Collection $users, array $likeables, int $size, Collection $existing): Collection
    {
        $batch = collect();

        while ($batch->count() < $size) {
            $like = $this->randomLike($users, $likeables);

            if ($existing->contains($like['key']) || $batch->has($like['key'])) {
                continue;
            }

            $batch->put($like['key'], $like['data']);
        }

        return $batch;
    }

    private function randomLike(Collection $users, array $likeables): array
    {
        $type       = array_rand($likeables);
        $likeableId = $likeables[$type]->random();
        $userId     = $users->random();
        $createdAt  = fake()->dateTimeBetween('-3 months', 'now');

        return [
            'key'  => "{$userId}-{$type}-{$likeableId}",
            'data' => [
                'user_id'       => $userId,
                'likeable_type' => $type,
                'likeable_id'   => $likeableId,
                'created_at'    => $createdAt,
                'updated_at'    => fake()->dateTimeBetween($createdAt, 'now'),
            ],
        ];
    }
}
