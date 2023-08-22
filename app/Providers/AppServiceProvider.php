<?php

namespace App\Providers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
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

        Gate::define("teacher", function (User $user, Classroom $classroom) {
            return $classroom->users()
                ->wherePivot("user_id", $user->id)
                ->wherePivot("role", "teacher")
                ->exists();
        });

    }
}
