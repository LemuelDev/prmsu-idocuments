<?php

namespace App\Providers;

use App\Models\Courses;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('shared.navbar', function ($view) {
            $user = auth()->user();
            $courseAbr = Courses::where('courses', $user->userProfile->course)->value('courses_abr');
            $view->with('courseAbr', $courseAbr);
        });
    }
}
