<?php

namespace App\Services\Contracts;

interface CourseContract
{

    public function getAllCourses();
    public function getCourseDetails($id);
    public function getRelatedCourses($id);
    public function createCourse($data);
    public function updateCourse($id, $data);
    public function deleteCourse($id);
    public function searchCourses($searchTerm);
    public function getTopRatedCourses($limit = 5);
    public function getPopularCourses($limit = 5);
    public function getRecentlyAddedCourses($limit = 5);
    public function getCoursesByCategory($categoryId);
    public function getCourseByInstructor($instructorId);
    public function getCourseByStudent($studentId);
}
