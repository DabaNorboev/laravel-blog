<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Services\Category\Service;

class CategoryController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $categories = Category::query()->with([
            'posts' => fn ($q) => $q
                ->withCount('likes')
                ->orderByLikes()
                ->limit(3)
        ])->get();


        return view('categories.index')->with('categories', $categories);
    }

    public function show(Category $category)
    {
        return view('categories.show')->with('category', $category);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $this->service->store($data);

        return redirect()->route('categories.index');
    }

    public function edit(Category $category)
    {
        return view('categories.edit')->with('category', $category);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $data = $request->validated();

        $this->service->update($data, $category);

        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->service->destroy($category);

        return redirect()->route('categories.index');
    }
}
