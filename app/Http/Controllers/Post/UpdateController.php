<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();

        $this->service->update($data, $post);

        return redirect()->route('posts.show', $post->id);
    }
}

