<?php

namespace App\Http\Controllers;

use App\Actions\CreateSubscriptionAction;
use App\Actions\UpdateSubscriptionAction;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Throwable;

class SubscriptionController extends Controller
{

// we use (action - service pattern) because the controller responsbility is to get request and return response without any business logic

   public function store(CreateSubscriptionRequest $request,CreateSubscriptionAction $create,UpdateSubscriptionAction $update){


          if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't subscribe twice");
          }


        $plan = Plan::findOrFail($request->plan_id); // exists:plans,id i check it here
        $months = $request->months;

          if(Gate::allows("subscriped")){
            $subscription = $request->user()->validSubscription;
             try {  // i add try catch here to handle errors inside controller not action

                  $subscription = $update($subscription,
                   [
                // i use forceCreate when i need escape the fillables in model (should not use it with request->all())
                "plan_id" => $plan->id,
                "price" => $plan->price * $months,
                "period" => $months,
                "expires_at" => now()->addMonths($months),
            ]);

                }catch(Throwable $ex){
                return back()->with("error", $ex->getMessage());
                }




          }else{
                try {  // i add try catch here to handle errors inside controller not action

                    $subscription = $create([
                        "plan_id" => $plan->id,
                        "user_id" => $request->user()->id,
                        "price" => $plan->price * $months,
                        "period" => $months,
                        "expires_at" => now()->addMonths($months),
                    ]);

                }catch(Throwable $ex){
                return back()->with("error", $ex->getMessage());
                }

          }


        // return  redirect()->route("payments.create", $subscription->id);
        return  redirect()->route("payments.pay", $subscription->id);


   }

}
