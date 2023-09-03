<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class markNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=Auth::check();
        $id = $request->query("nid");

        if($id && $user){

                $notification = $request->user()->unreadNotifications()->find($request->query("nid"));
                $notification?->markAsRead();


            }

        return $next($request);
    }
}
