<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(StoreRequest $request, Post $post)
    {
        $data = $request->validated();

        Comment::create([
            'message' => $data['comment'],
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back();
    }
}
