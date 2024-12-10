<?php

namespace App\Services\Services;

use App\Dto\AuthDto;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Services\Contracts\AuthContract;


class AuthService implements AuthContract
{
    protected AuthRepository $authRepository;
    public function __construct()
    {
        $this->authRepository = new AuthRepository();
    }

    public function register(AuthDto $authDto): User
    {
        $user = $this->authRepository->register($authDto);
        return $user;
    }
    public function instructorRegister(AuthDto $authDto): User
    {
        $user = $this->authRepository->instructorRegister($authDto);
        return $user;
    }


    public function login(AuthDto $authDto): User|null
    {
        $user = $this->authRepository->login($authDto);
        return $user;
    }
    public function logout(): void
    {
        $this->authRepository->logout();
    }
}
