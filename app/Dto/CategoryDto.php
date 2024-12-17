<?php

namespace App\Dto;

use App\Http\Requests\CategoryRequest;



class CategoryDto
{

    public function __construct() {}
    public static function formArray(CategoryRequest  $request): self
    {
        return new self();
    }
}
