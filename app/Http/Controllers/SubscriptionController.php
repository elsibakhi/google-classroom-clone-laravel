<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubscriptionController extends Controller
{



   public function store(Request $request){


          if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't subscribe twice");
          }

        $request->validate([
            "plan_id" => ["required", "integer", "exists:plans,id"], // exists:plans,id i check it bellow but i will remine it
            "months" => ["required", "integer", "min:1", "max:12"],
        ]);

        $plan = Plan::findOrFail($request->plan_id); // exists:plans,id i check it here
        $months = $request->months;

          if(Gate::allows("subscriped")){
            $subscription = $request->user()->validSubscription;
            $subscription->update([
                // i use forceCreate when i need escape the fillables in model (should not use it with request->all())
                "plan_id" => $plan->id,
                "price" => $plan->price * $months,
                "period" => $months,
                "expires_at" => now()->addMonths($months),
            ]);

          }else{

              $subscription =Subscription::forceCreate([
                        "plan_id"=>$plan->id,
                        "user_id"=>$request->user()->id,
                        "price"=>$plan->price*$months,
                         "period" => $months,
                        "expires_at"=>now()->addMonths($months),
                ]);
          }


        return  redirect()->route("payments.create", $subscription->id);


   }

}
