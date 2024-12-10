<?php

namespace App\Repositories;

use App\Dto\PersonalizeDto;
use App\Models\Student;

class PersonalizeRepository
{

    protected  Student $student;
    public function __construct()
    {
        $this->student = new Student();
    }
    public function updatePersonalize($id, PersonalizeDto $data): Student
    {

        $student = Student::where('user_id', $id)->first();
        if (!$student) {
            throw new \Exception('Student not found');
        }
        $student->interests_field = $data->interestsField;
        $student->save();

        return $student;
    }
}
