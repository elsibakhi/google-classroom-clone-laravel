<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserHasNotExceededMaxAllowedClassroomsNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                $user = $request->user();
    

                $allowed_classrooms_number=$user
                ->subscriptions()
                ->where("expires_at", ">=", now())
                ->first()
                ->plan->features()->where("name","Classroom #")->first()->pivot->feature_value;


             if($user->ownedClassrooms()->count()==$allowed_classrooms_number){
                  abort(403, "You have used the maximum number of allowed classrooms ");
             }


        return $next($request);
    }
}
