<?php

use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccountController,
    AdminController,
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
    QuizController,
};
use App\Http\Controllers\Auth\PasswordResetController;

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
Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/update', [PasswordResetController::class, 'reset'])->name('password.update');
Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');

    Route::get('/settings', [AccountController::class, 'edit'])->name('settings');
    Route::middleware('verified')->put('/settings', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/settings/delete', [AccountController::class, 'delete'])->name('account.delete');
    Route::get('/instructor/review/{id}', [ReviewController::class, 'show'])->name('instructor.review');
    Route::get('/notification/{id}/read', [NotificationController::class, 'read'])->name('notification.read');
    Route::post('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');
    Route::delete('/notifications/{id}', [NotificationController::class, 'delete'])->name('notification.delete');

    Route::get('/banned', function () {
        return view('instructor.banned');
    })->name('banned.page');

    Route::get('/contact-support', [SupportController::class, 'index'])->name('support.contact');
    Route::post('/contact-support', [SupportController::class, 'submit'])->name('support.submit');

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
        Route::delete('/my-learning/{course_id}/delete', [MyLearningController::class, 'destroy'])->name('my-learning.delete');
        Route::get('/my-learning/lesson/{lesson_id}', [LessonController::class, 'complete'])->name('lesson.complete');
        Route::post('/reviews/store/{entityType}/{entityId}', [ReviewController::class, 'store'])->name('review.store');
        Route::get('/reviews/edit/{entityType}/{entityId}/{reviewId}', [ReviewController::class, 'edit'])->name('review.edit');
        Route::put('/reviews/update/{entityType}/{entityId}/{reviewId}', [ReviewController::class, 'update'])->name('review.update');
        Route::delete('/courses/{entityId}/reviews/{reviewId}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::get('/quiz/start/{lesson_id}', [QuizController::class, 'start'])->name('quiz.start');
        Route::post('/quiz/submit/{quiz_id}', [QuizController::class, 'submit'])->name('quiz.submit');
        Route::get('courses/{course}/generate-certificate', [CourseController::class, 'generateCertificate'])->name('courses.generate-certificate');
        Route::get('certificates/verify', [CourseController::class, 'verifyCertificat'])->name('certificate.verify');
        Route::post('/learning/add', [MyLearningController::class, 'addToLearning'])->name('learning.add');
    });

    // Instructor Routes
    Route::prefix('instructor')->middleware(['role:instructor', 'check.instructor.banned'])->group(function () {
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
        Route::get('/lessons/{lesson}/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
        Route::post('/lessons/{lesson}/quiz', [QuizController::class, 'store'])->name('quiz.store');
        Route::get('/lesson/{lesson}/quiz/edit', [QuizController::class, 'edit'])->name('quiz.edit');
        Route::put('/lesson/{lesson}/quiz', [QuizController::class, 'update'])->name('quiz.update');
    });

    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.manage.users');
        Route::get('/categories', [AdminController::class, 'manageCategories'])->name('admin.manage.categories');
        Route::get('/payments', [AdminController::class, 'managePayments'])->name('admin.manage.payments');
        Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
        Route::get('/settings', [AdminController::class, 'settingsPage'])->name('admin.settings');
        Route::get('/admin/users/edit/{id}', [AdminController::class, 'editUser'])->name('admin.edit-user');
        Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.delete-user');
        Route::patch('/admin/users/{id}/toggle-ban', [AdminController::class, 'toggleBan'])
            ->name('admin.users.toggle-ban');
        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::get('admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.create-category');
        Route::post('admin/categories/store', [AdminController::class, 'storeCategory'])->name('admin.store-category');

        Route::put('categories/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.update-category');
        Route::get('categories/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.edit-category');
        Route::get('categories/delete/{id}', [AdminController::class, 'destroyCategory'])->name('admin.delete-category');
        Route::get('admin/payment-analysis', [AdminController::class, 'paymentAnalysis'])->name('admin.payment-analysis');
        Route::get('admin/notifications', [AdminController::class, 'notifications'])->name('admin.notifications');
        Route::post('/admin/delete-payment-history', [AdminController::class, 'deletePaymentHistory'])->name('admin.delete-payment-history');

        Route::get('admin/reports/export-pdf', [AdminController::class, 'exportPDF'])->name('admin.reports.export-pdf');

        Route::get('admin/reports/export-Excel', [AdminController::class, 'exportExcel'])->name('admin.reports.export');
        Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.update-settings');
        Route::get('/admin/profile', [AdminController::class, 'profileEdit'])->name('admin.profile');
        Route::put('/admin/profile', [AdminController::class, 'profileUpdate'])->name('admin.update-profile');
    });
});
