<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlanRequest;
use App\Models\Feature;
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


// admin

public function create(){
        $features = Feature::all();
        return view("admin.plans.create",compact("features"));
}

public function store(CreatePlanRequest $request){
        $validated = $request->validated();

          $featured = isset($validated['featured']) ;
          if($featured){
            Plan::where("featured","=",1)->update(["featured"=>0]);
          }
      $plan = Plan::create([
            "name"=>$validated['name'],
            "description"=>$validated['description'],
            "price"=>$validated['price'],
            "featured"=>$featured,
        ]);

           $plan_features=[];
           foreach ($validated['features'] as $id => $value) {
                $plan_features[$id]=["feature_value"=>$value];
           }

        // dd(...$plan_features);
        $plan->features()->attach(
          $plan_features
        );
           return back()->with("success","The plan added successfully");
}


}
