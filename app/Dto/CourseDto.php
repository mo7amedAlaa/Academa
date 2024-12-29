<?php

namespace App\Dto;

use App\Http\Requests\CourseRequest;

class CourseDto
{

    public function __construct(public string $title, public string $description, public float $price = 0.0, public ?float $discount = null, public ?int $max_students = null, public ?int $duration_hours, public ?string $cover_image = null, public  $start_date = null, public  ?string $status = null, public ?bool $isFree = false, public int $category_id, public int $level_id, public int $instructor_id) {}
    public static function formArray(CourseRequest  $request): self
    {
        $cover_image = null;
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = uniqid('course_') . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/courses');
            $image->move($destinationPath, $imageName);
            $cover_image = 'uploads/courses/' . $imageName;
        }
        $instructor_id = auth()->user()->instructor->id;
        $price = $request->has('price') ? (float) $request->price : 0.0;

        return new self(
            title: $request->title,
            description: $request->description,
            price: $price,
            discount: $request->discount,
            max_students: $request->max_students,
            duration_hours: $request->duration_hours,
            cover_image: $cover_image,
            start_date: $request->start_date,
            status: $request->status,
            isFree: $request->isFree,
            category_id: $request->category_id,
            level_id: $request->level_id,
            instructor_id: $instructor_id
        );
    }
}
