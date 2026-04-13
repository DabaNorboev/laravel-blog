<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\Post\FilterRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;

class IndexController extends BaseController
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $tags = Tag::all();
        $categories = Category::all();

        $sortOptions = [
            'newest' => ['created_at', 'desc'],
            'oldest' => ['created_at', 'asc'],
            'popular' => ['likes', 'desc'],
        ];

        $postsQuery = Post::query()->
            when($data['category_id'] ?? null, fn ($q) => $q->where('category_id', $data['category_id']))->
            when($data['search'] ?? null, fn ($q) => $q->whereAny(['title', 'content'], 'ilike', "%{$data['search']}%"))->
            when($data['tags'] ?? null, fn ($q) => $q->whereHas('tags', fn ($q) => $q->whereIn('tag_id', $data['tags'])))->
            when($data['sort'] ?? null, function ($q) use ($data) {
                if (isset($sortOptions[$data['sort']])) {
                    $q->orderBy(...$sortOptions[$data['sort']]);
                }
        });


        if (!empty($data['sort'])) {
            $postsQuery->when(isset($sortOptions[$data['sort']]), function ($query) use ($sortOptions, $data) {
                $query->orderBy(...$sortOptions[$data['sort']]);
            });
        }


        //filter by category_id
        if (!empty($data['category_id'])) {
            $postsQuery->where('category_id', $data['category_id']);
        }

        //search in title/content column
        if (!empty($data['search'])) {
            $search = Str::lower($data['search']);
            $postsQuery->whereAny(['title', 'content'], 'like', "%{$search}%");
        }

        //filter by tags
        if (!empty($data['tags'])) {
            $postsQuery->whereHas('tags',
                function ($query) use ($data) {
                    $query->whereIn('tag_id', $data['tags']);
                });
        }

        $posts = $postsQuery->paginate(10)->withQueryString();

        return view('posts.index')->with(['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }
}

