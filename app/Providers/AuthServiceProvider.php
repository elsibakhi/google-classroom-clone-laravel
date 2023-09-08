<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {


        Gate::define("teacher", function (User $user, Classroom $classroom) {
            return $classroom->users()
                ->wherePivot("user_id", $user->id)
                ->wherePivot("role", "teacher")
                ->exists();
        });

        Gate::define("classroom.join", function (User $user, Classroom $classroom) {

            $user = $classroom->user;

                $allowed_users_number=$user
                ->subscriptions()
                ->where("expires_at", ">=", now())
                 ->where("status","confirmed")
                ->first()
                ->plan->features()->where("name","Students Per Classroom")->first()->pivot->feature_value;

            // dd($classroom->users()->count(), $allowed_users_number);
             if($classroom->users()->count()==$allowed_users_number){
                 return Response::deny('This classroom is currently full.');
            }

            return Response::allow();

        });
  Gate::define("subscriped", function (User $user) { // the same as middleware i define it

   return   $user->subscriptions()
        ->where("expires_at", ">=", now())
        ->exists();



        });
  Gate::define("subscription.confirmed", function (User $user) { // the same as middleware i define it

   return   $user->subscriptions()
        ->where("expires_at", ">=", now())
        ->where("status","confirmed")
        ->exists();



        });







    }

}
