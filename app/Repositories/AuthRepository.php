<?php

namespace App\Repositories;

use App\Dto\AuthDto;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    protected User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function register(AuthDto $authDto): ?User
    {
        $user = new User();
        $user->name = $authDto->name;
        $user->email = $authDto->email;
        $user->password =  $authDto->password;
        $user->avatar = $authDto->avatar;
        $user->save();
        $user->assignRole('student');
        $student = new Student();
        $student->user_id = $user->id;
        $student->save();
        $user->sendEmailVerificationNotification();
        Auth::login($user);
        return $user;
    }

    public function instructorRegister(AuthDto $authDto): ?User
    {

        $user = new User();
        $user->name = $authDto->name;
        $user->email = $authDto->email;
        $user->password = $authDto->password;
        $user->avatar = $authDto->avatar;
        $user->save();
        $user->assignRole('instructor');
        $instructor = new Instructor();
        $instructor->user_id = $user->id;
        $instructor->bio = $authDto->bio;
        $instructor->phone = $authDto->phone;
        $instructor->nationality = $authDto->nationality;
        $instructor->age = $authDto->age;
        $instructor->experience_card = $authDto->experience_card;
        $instructor->experience_years = $authDto->experience_years;
        $instructor->ssn = $authDto->ssn;
        $instructor->save();
        $user->sendEmailVerificationNotification();
        Auth::login($user);
        return $user;
    }

    public function login(AuthDto $authDto): ?User
    {
        $credentials = [
            'email' => $authDto->email,
            'password' => $authDto->password,
        ];

        if (Auth::attempt($credentials, $authDto->remember)) {

            return Auth::user();
        }

        return null;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
