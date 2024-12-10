<?php

namespace App\Http\Controllers;

use App\Dto\AuthDto;
use App\Events\newNotification;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Instructor;
use App\Services\Facades\AuthFacade;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {

        $user = AuthFacade::register(AuthDto::store($request));
        if ($user) {



            $user->sendEmailVerificationNotification();
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('instructor')) {
                $instructor = Instructor::where('user_id', $user->id)->first();
                return redirect()->route('instructors.dashboard', $instructor->id);
            } elseif ($user->hasRole('student')) {
                return redirect()->route('student.dashboard');
            }
            return redirect()->route('welcome');
        }
        return redirect()->back()->withErrors(['email' => 'some error']);
    }


    public function authenticate(LoginRequest $request)
    {
        $user = AuthFacade::login(AuthDto::authenticate($request));
        if ($user) {
            $user = Auth::user();

            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('instructor')) {
                return redirect()->route('instructors.dashboard');
            } elseif ($user->hasRole('student')) {
                return redirect()->route('student.dashboard');
            }
            return redirect()->route('welcome');
        }
        return redirect()->back()->withErrors(['email' => 'Invalid email or password']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }


    public function welcome()
    {
        return view('welcome');
    }

    // Additional methods to show dashboards for roles
    public function adminDashboard()
    {
        $this->authorizeRole('admin');
        return view('admin.dashboard');
    }

    public function instructorDashboard(Request $request)
    {
        $user = Auth::user();

        // Authorize the role
        $this->authorizeRole('instructor');

        // Fetch the instructor
        $instructor = $user->instructor()->with(['user', 'reviews'])->first();

        if (!$instructor) {
            abort(404, 'Instructor not found.');
        }

        $query = $instructor->courses();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('filter')) {
            $query->where('status', $request->input('filter'));
        }

        if ($request->has('is_free')) {
            $query->where('isFree', true);
        }

        $courses = $query->withCount('students')->get();

        $averageRating = $instructor->reviews->isNotEmpty()
            ? $instructor->reviews->avg('rating')
            : null;

        return view('instructor.dashboard', [
            'instructor' => $instructor,
            'courses' => $courses,
            'averageRating' => $averageRating,
        ]);
    }

    public function studentDashboard()
    {
        $student = auth()->user()->student;
        $this->authorizeRole('student');
        $interCourses = Course::where('category_id', '=', $student->interests_field)->get();
        $category = Category::find($student->interests_field);
        $recommendedTopics = $category?->subcategories()->limit(6)->get();
        return view('student.dashboard', compact('interCourses', 'category', 'recommendedTopics'));
    }

    protected function authorizeRole(string $role)
    {
        if (!auth()->user()->hasRole($role)) {
            abort(403, 'Unauthorized access');
        }
    }
}
