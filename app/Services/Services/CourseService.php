<?php

namespace App\Services\Services;

use App\Repositories\CourseRepository;
use App\Services\Contracts\CourseContract;

class CourseService implements CourseContract
{
    protected CourseRepository $courseRepository;
    public function __construct()
    {
        $this->courseRepository = new CourseRepository();
    }
    public function getAllCourses()
    {
        return $this->courseRepository->getAllCourses();
    }
    public function getCourseDetails($id)
    {
        return $this->courseRepository->getCourseDetails($id);
    }
    public function getRelatedCourses($id)
    {
        return $this->courseRepository->getRelatedCourses($id);
    }

    public function createCourse($data)
    {
        return $this->courseRepository->createCourse($data);
    }
    public function updateCourse($id, $data)
    {
        return $this->courseRepository->updateCourse($id, $data);
    }
    public function deleteCourse($id)
    {
        return $this->courseRepository->deleteCourse($id);
    }
    public function searchCourses($searchTerm)
    {
        return $this->courseRepository->searchCourses($searchTerm);
    }
    public function getTopRatedCourses($limit = 5)
    {
        return $this->courseRepository->getTopRatedCourses($limit);
    }
    public function getPopularCourses($limit = 5)
    {
        return $this->courseRepository->getPopularCourses($limit);
    }
    public function getRecentlyAddedCourses($limit = 5)
    {
        return $this->courseRepository->getRecentlyAddedCourses($limit);
    }
    public function getCoursesByCategory($categoryId)
    {
        return $this->courseRepository->getCoursesByCategory($categoryId);
    }
    public function getCourseByInstructor($instructorId)
    {
        return $this->courseRepository->getCourseByInstructor($instructorId);
    }
    public function getCourseByStudent($studentId)
    {
        return $this->courseRepository->getCourseByStudent($studentId);
    }
}
