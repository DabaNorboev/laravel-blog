<?php

namespace App\Services\Category;

use App\Models\Category;

class Service
{
    public function store(array $data): void
    {
        Category::create($data);
    }

    public function update(array $data, Category $category): void
    {
        $category->update($data);
    }

    public function destroy(Category $category): void
    {
        $category->delete();
    }
}
