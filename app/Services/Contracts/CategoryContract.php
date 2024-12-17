<?php

namespace App\Services\Contracts;

interface CategoryContract
{
    public function getAllCategories_sub();
    public function getMainCategories();
    public function showInboxCourses($id);
}
