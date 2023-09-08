<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{


 public function create($id){
            if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't pay twice");
          }
      $subscription= Auth::user()->subscriptions()->where("expires_at",">=",now())->findOrfail($id);

        return view("plans.pay",compact("subscription"));
  }


 public function pay(Request $request){

            if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't pay twice");
          }
    $subscription= Auth::user()->subscriptions()->where("expires_at",">=",now())->findOrfail($request->subscription_id);

      $stripe = new \Stripe\StripeClient(config("services.stripe.secret"));





    try {


         // Create a PaymentIntent with amount and currency
        $paymentIntent = $stripe->paymentIntents->create([
        'amount' => $subscription->price*100,
        'currency' => 'usd',
        // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
        'automatic_payment_methods' => [
            'enabled' => true,
        ],
        "metadata"=>[
            "subscription_id"=>$subscription->id
                 ]
             ]);

         return [
        'clientSecret' => $paymentIntent->client_secret,
          ];

    //    dd($output);
        } catch (Error $e) {

             return  response(['error' => $e->getMessage()],500);
            }


  }

public function success(Request $request){

            $stripe = new \Stripe\StripeClient(config("services.stripe.secret"));
            $result =$stripe->paymentIntents->retrieve(
            $request->payment_intent ,
            []
            );

                $subscription =  Auth::user()->subscriptions()->findOrFail($result->metadata["subscription_id"]);
                  $subscription->update([
                    "status" => "confirmed",
                    "expires_at"=>now()->addMonths($subscription->period)
                ]);


                    return redirect()->route("classrooms.index")->with("success", "You are now subscribed to " . $subscription->plan->name . " plan");


 }





}
