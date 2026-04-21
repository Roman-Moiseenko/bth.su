<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepository
{
    public function getAll(): array
    {
        return Category::orderBy('name')
            ->get()
            ->map(fn(Category $category) => $this->get($category))
            ->toArray();
    }
    private function get(Category $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'description' => $category->description,
        ];
    }
}
