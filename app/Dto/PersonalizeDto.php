<?php

namespace App\Dto;

use App\Http\Requests\PersonalizeRequest;

class PersonalizeDto
{
    public function __construct(
        public readonly string $interestsField,
        public readonly string $managePeople,
    ) {}
    public static function fromRequest(PersonalizeRequest $request): PersonalizeDto
    {
        return new self(
            interestsField: $request->interests_field,
            managePeople: $request->manage_people,
        );
    }
}
