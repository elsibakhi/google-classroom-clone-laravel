<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TwoFactorAuthenticationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user=$request->user();
        return view("auth.two-factor-authentication",compact("user"));
    }
}
