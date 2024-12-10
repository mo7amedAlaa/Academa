<?php

namespace App\Services\Contracts;



use App\DTO\FavoriteDto;
use Illuminate\Database\Eloquent\Collection;

interface FavoriteServiceContract
{
    public function addFavorite(FavoriteDto $dto): bool;

    public function removeFavorite(FavoriteDto $dto): bool;

    public function getFavorites(int $studentId): Collection;
}
