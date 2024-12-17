<?php

namespace App\Dto;

use App\Http\Requests\CartRequest;


class CartDto
{
    public int $id;
    public string $name;

    public float $price;
    public ?string $cover_image;

    public function __construct(int $id, string $name, float $price, ?string $cover_image = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->cover_image = $cover_image;
    }
    public static function formArray(CartRequest  $request): self
    {
        return new self(
            id: $request->id,
            name: $request->name,
            price: $request->price,
            cover_image: $request->cover_image,
        );
    }
}
