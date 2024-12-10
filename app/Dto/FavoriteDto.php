<?php

namespace App\Dto;

use App\Http\Requests\FavoriteRequest;

class FavoriteDto
{


    public function __construct(public int $studentId, public int $courseId) {}

    public static function fromArray(FavoriteRequest $data): self
    {
        return new self(studentId: $data['student_id'], courseId: $data['course_id']);
    }
}
