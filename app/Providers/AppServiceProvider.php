<?php

namespace App\Providers;

use App\Services\Facades\CourseFacade;
use App\Services\Services\CheckoutService;
use App\Services\Services\FavoriteService;
use Illuminate\Support\Facades\View;
use App\Repositories\SearchRepository;
use App\Services\Services\AuthService;
use Illuminate\Support\ServiceProvider;
use App\Services\Services\CourseService;
use App\Services\Services\SearchService;
use App\Services\Services\CategoryService;
use App\Services\Services\PersonalizeService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind SearchRepository to the container
        $this->app->bind(SearchRepository::class, function () {
            return new SearchRepository();
        });

        // Bind SearchService to the container

        $this->app->bind('searchService', function ($app) {
            return new SearchService($app->make(SearchRepository::class));
        });


        // Bind other services
        $this->app->bind(
            'authService',
            function () {
                return new AuthService();
            }
        );
        $this->app->bind(
            'categoryService',
            function () {
                return new CategoryService();
            }
        );
        $this->app->bind('courseService', function () {
            return new CourseService();
        });
        $this->app->bind('personalizeService', function () {
            return new PersonalizeService();
        });

        $this->app->bind('favoritesService',  function () {
            return new FavoriteService();
        });
        $this->app->bind('checkoutService',  function () {
            return new CheckoutService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $topRatedCourses = CourseFacade::getTopRatedCourses(20);
            $recentlyAddedCourses = CourseFacade::getRecentlyAddedCourses(20);
            $popularCourses = CourseFacade::getPopularCourses(5);
            $user = auth()->user();

            $view->with([
                'user' => $user,
                'categories' => app('categoryService')->getAllCategories_sub(),
                'topRatedCourses' => $topRatedCourses,
                'getRecentlyAddedCourses' => $recentlyAddedCourses,
                'popularCourses' => $popularCourses,

            ]);
        });

        View::composer('partials.Header', function ($view) {
            $id = auth()->id();
            $cart = session()->get("cart.$id", []);
            $productCount = count($cart);
            $view->with([
                'productCount' => $productCount
            ]);
        });
    }
}
