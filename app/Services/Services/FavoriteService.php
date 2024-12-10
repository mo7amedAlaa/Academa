<?php

namespace App\Services\Services;



use App\DTO\FavoriteDto;
use App\Repositories\FavoriteRepository;
use App\Services\Contracts\FavoriteServiceContract;
use Illuminate\Database\Eloquent\Collection;



class FavoriteService implements FavoriteServiceContract
{
    private FavoriteRepository $repository;

    public function __construct()
    {
        $this->repository = new FavoriteRepository();
    }

    public function addFavorite(FavoriteDto $dto): bool
    {
        return $this->repository->addFavorite($dto->studentId, $dto->courseId);
    }

    public function removeFavorite(FavoriteDto $dto): bool
    {
        return $this->repository->removeFavorite($dto->studentId, $dto->courseId);
    }

    public function getFavorites(int $studentId): Collection
    {
        return $this->repository->getFavorites($studentId);
    }
}
