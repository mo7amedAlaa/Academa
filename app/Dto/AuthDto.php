<?php

namespace App\Dto;

use App\Http\Requests\InstructorRegRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $name = null,
        public readonly ?string $avatar = null,
        public readonly ?string $bio = null,
        public readonly ?string $phone = null,
        public readonly ?string $nationality = null,
        public readonly ?int $age = null,
        public readonly ?string $experience_card = null,
        public readonly ?int $experience_years = null,
        public readonly ?string $ssn = null,
    ) {}

    public static function store(RegisterRequest $request): AuthDto
    {
        $avatarPath = null;
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $avatar = $request->file('avatar');
            $avatarName = uniqid('avatar_') . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('uploads/avatars/'), $avatarName);
            $avatarPath = "uploads/avatars/" . $avatarName;
        }

        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            avatar: $avatarPath,
        );
    }

    public static function authenticate(LoginRequest $request): AuthDto
    {
        return new self(
            email: $request->email,
            password: $request->password,
        );
    }

    public static function instructorsStore(InstructorRegRequest $request): AuthDto
    {
        $avatarPath = null;
        $experienceCardPath = null;


        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {

            $avatar = $request->file('avatar');
            $avatarName = uniqid('avatar_') . '.' . $avatar->getClientOriginalExtension();

            $avatar->move(public_path('uploads/avatars/'), $avatarName);
            $avatarPath = "uploads/avatars/" . $avatarName;
        }

        if ($request->hasFile('experience_card') && $request->file('experience_card')->isValid()) {

            $experienceCard = $request->file('experience_card');
            $experienceCardName = uniqid('card_') . '.' . $experienceCard->getClientOriginalExtension();
            $experienceCard->move(public_path('uploads/experience_cards/'), $experienceCardName);
            $experienceCardPath = "uploads/experience_cards/" . $experienceCardName;
        }

        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            avatar: $avatarPath,
            bio: $request->bio,
            phone: $request->phone,
            nationality: $request->nationality,
            age: $request->age,
            experience_card: $experienceCardPath,
            experience_years: $request->experience_years,
            ssn: $request->ssn
        );
    }
}
