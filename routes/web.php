<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccountController,
    AuthController,
    CartController,
    CategoryController,
    CheckoutController,
    CourseController,
    FavoriteController,
    InstructorController,
    LessonController,
    MyLearningController,
    PersonalizeController,
    SearchController,
    ProfileController,
    VerificationController,
    ReviewController,
    NotificationController,
};

// Public Routes
Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/categories/{id}/courses', [CategoryController::class, 'showCourses'])->name('categories.courses');
Route::get('/instructors/create', [InstructorController::class, 'create'])->name('instructors.create');
Route::post('/instructors', [InstructorController::class, 'store'])->name('instructors.store');


// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');

    Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    Route::get('/settings', [AccountController::class, 'edit'])->name('settings');
    Route::middleware('verified')->put('/settings', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/settings/delete', [AccountController::class, 'delete'])->name('account.delete');
    Route::get('/instructor/review/{id}', [ReviewController::class, 'show'])->name('instructor.review');
    Route::get('/notification/{id}/read', [NotificationController::class, 'read'])->name('notification.read');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::prefix('student')->middleware('role:student')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'studentDashboard'])->name('student.dashboard');
        Route::get('/personalize', [PersonalizeController::class, 'index'])->name('personalize');
        Route::post('/personalize', [PersonalizeController::class, 'store']);
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/add', [FavoriteController::class, 'add'])->name('favorites.add');
        Route::post('/favorites/remove', [FavoriteController::class, 'remove'])->name('favorites.remove');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
        Route::get('/my-learning', [MyLearningController::class, 'index'])->name('my-learning');
        Route::get('/my-learning/{course_id}', [MyLearningController::class, 'show'])->name('courses.content');
        Route::post('/reviews/store/{entityType}/{entityId}', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/reviews/edit/{entityType}/{entityId}/{reviewId}', [ReviewController::class, 'edit'])->name('review.edit');
        Route::put('/reviews/update/{entityType}/{entityId}/{reviewId}', [ReviewController::class, 'update'])->name('review.update');
        Route::delete('/courses/{entityId}/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    });

    // Instructor Routes
    Route::prefix('instructor')->middleware('role:instructor')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'instructorDashboard'])->name('instructors.dashboard');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::get('/courses/{course}/content', [CourseController::class, 'manageContent'])->name('instructor.courses.content');
        Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    });
});
