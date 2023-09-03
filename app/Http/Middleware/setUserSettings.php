<?php

namespace App\Http\Middleware;

use App\Traits\SetLocale;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class setUserSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
             $user=Auth::user();
            App::setLocale($user->profile->locale);


        }else{

             $locale = SetLocale::get($request);

             App::setLocale($locale);
            //  dd(App::currentLocale());
        }

        return $next($request);
    }
}
