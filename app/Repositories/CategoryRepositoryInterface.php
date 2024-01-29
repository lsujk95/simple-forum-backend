<?php

namespace App\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    /** Gets all categories
     * @return Collection|null
     */
    public function getAll(): ?Collection;

    /** Gets categories with forums
     * @return Collection|null
     */
    public function getAllWithForums(): ?Collection;

    /** Creates a new category
     * @param array $attributes
     * @return Category|null
     */
    public function create(array $attributes): ?Category;

    /** Updates the category data
     * @param Category $category
     * @param array $attributes
     * @return bool|null
     */
    public function update(Category $category, array $attributes): ?bool;

    /** Deletes the category
     * @param Category $category
     * @return bool|null
     */
    public function delete(Category $category): ?bool;

}
