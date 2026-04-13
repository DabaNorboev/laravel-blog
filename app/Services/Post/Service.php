<?php

namespace App\Services\Post;

use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;

class Service
{
    public function store(array $data): void
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $post = Post::create($data);

        if (!empty($tags)) {
            $post->tags()->attach($tags);
        }
    }

    public function update(array $data, Post $post): void
    {
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        $post->update($data);
        $post->tags()->sync($tags);
    }

    public function destroy(Post $post): void
    {
        $post->delete();
    }
}
