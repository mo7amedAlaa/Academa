<?php

namespace App\Services\Contracts;

use App\Dto\AuthDto;
use App\Models\User;

interface AuthContract
{

    public function register(AuthDto $authDto): User;


    public function login(AuthDto $authDto): ?User;
    public function logout(): void;
    public function instructorRegister(AuthDto $authDto): User;
}
