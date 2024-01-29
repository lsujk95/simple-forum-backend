<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): ?Collection
    {
        return Category::all();
    }

    public function getAllWithForums(): ?Collection
    {
        return Category::with('forums')->get();
    }

    public function create(array $attributes): ?Category
    {
        $category = new Category();
        $category->fill($attributes);

        if (!$category->save()) {
            return null;
        }

        return $category;
    }

    public function update(Category $category, array $attributes): ?bool
    {
        return $category->update($attributes);
    }

    public function delete(Category $category): ?bool
    {
       return $category->delete();
    }
}
