<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header("x-api-key");

        if(!$key || $key!=config("app.api_key")){
            return  response()->json([
                "message" => "Missing or invalid api key",

            ], 400);
        }
        return $next($request);
    }
}
