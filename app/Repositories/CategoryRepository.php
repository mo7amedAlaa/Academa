<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected Category $category;
    public function __construct()
    {
        $this->category = new Category();
    }
    public function getAllCategories_sub()
    {
        return $this->category->with('subcategories')->get();
    }
    public function getMainCategories()
    {
        return $this->category->where('parent_id', null)->get();
    }
}
