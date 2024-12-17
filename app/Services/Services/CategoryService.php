<?php

namespace App\Services\Services;

use App\Repositories\CategoryRepository;
use App\Services\Contracts\CategoryContract;

class CategoryService implements CategoryContract
{
    protected  CategoryRepository $categoryRepository;
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }
    public function getAllCategories_sub()
    {
        return $this->categoryRepository->getAllCategories_sub();
    }
    public function showInboxCourses($id)
    {
        return $this->categoryRepository->showInboxCourses($id);
    }

    public function getMainCategories()
    {
        return $this->categoryRepository->getMainCategories();
    }
}
