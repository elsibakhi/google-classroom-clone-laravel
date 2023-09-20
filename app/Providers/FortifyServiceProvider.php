<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Fortify;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

            if(request()->is("admin","admin/*")){

            Config::set([
                    "fortify.guard"=>"admin",
                    "fortify.password"=>"admins",
                    "fortify.username"=>"username",
                    "fortify.prefix"=>"admin",
                    "fortify.home"=>"admin/dashboard",
            ]);
            }

         $this->app->instance(LoginResponse::class, new class implements LoginResponse {
        public function toResponse($request)
        {

            if(Auth::user()){

                return redirect('/');

            }else{

                return redirect()->route("admin.dashboard");
            }
        }
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       Fortify::twoFactorChallengeView(function () {
        return view('auth.two-factor-challenge');
    });


        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::viewPrefix("auth."); // this line define all views (login,register,reset password , .....)
        // Fortify::loginView("auth.login");
        // Fortify::registerView("auth.register");
        // and so on .....

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
