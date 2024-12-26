<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Course;
use App\Models\Payment;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;

class ReportExport implements FromArray
{
    private $type;
    private $startDate;
    private $endDate;

    public function __construct($type, $startDate, $endDate)
    {
        $this->type = $type;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function array(): array
    {
        $data = [];
        switch ($this->type) {
            case 'users':
                $query = User::query();
                if ($this->startDate) $query->where('created_at', '>=', $this->startDate);
                if ($this->endDate) $query->where('created_at', '<=', $this->endDate);
                $data = $query->get(['id', 'name', 'email', 'created_at'])->toArray();
                break;

            case 'courses':
                $query = Course::query();
                if ($this->startDate) $query->where('created_at', '>=', $this->startDate);
                if ($this->endDate) $query->where('created_at', '<=', $this->endDate);
                $data = $query->get(['id', 'title', 'price', 'created_at'])->map(function ($course) {
                    return [
                        'id' => $course['id'],
                        'title' => $course['title'],
                        'price' => $course['price'],
                        'created_at' => $course['created_at'],
                        'students_registered' => $course->students()->count(),
                        'instructor' => $course->instructor ? $course->instructor->name : 'N/A',
                        'rating' => $course->rating ?? 'Not Rated'
                    ];
                })->toArray();
                break;

            case 'stats':
                $data = [
                    ['Description' => 'Total Users', 'Value' => User::count()],
                    ['Description' => 'Total Courses', 'Value' => Course::count()],
                    ['Description' => 'Total Instructors', 'Value' => User::role('instructor')->count()],
                    ['Description' => 'Total Students', 'Value' => User::role('student')->count()],
                    ['Description' => 'Total Payments', 'Value' => Payment::count()],
                ];
                break;
        }

        return $data;
    }
}
