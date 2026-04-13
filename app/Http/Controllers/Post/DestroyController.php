<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;

class DestroyController extends BaseController
{
    public function __invoke(Post $post)
    {
        $this->service->destroy($post);

        return redirect()->route('posts.index');
    }
}

