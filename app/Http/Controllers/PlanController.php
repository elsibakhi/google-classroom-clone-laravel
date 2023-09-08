<?php

namespace App\Http\Controllers;

use App\Models\Plan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{


public function index(){

    if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't subscribe twice");
          }

        $plans = Plan::all();
        return view("plans.index",compact('plans'));
}



}
