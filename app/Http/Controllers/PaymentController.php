<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\Payments\StripePayment;
use Error;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Stripe\StripeClient;
use Throwable;

class PaymentController extends Controller
{


 public function create($id){
            if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't pay twice");
          }
      $subscription= Auth::user()->subscriptions()->where("expires_at",">=",now())->findOrfail($id);

        return view("plans.pay",compact("subscription"));
  }


 public function pay(StripePayment $stripePayment,$subsription_id){

            if(Gate::allows("subscription.confirmed")){
            abort(403, "You can't pay twice");
          }
 $subscription= Auth::user()->subscriptions()->where("expires_at",">=",now())->findOrfail($subsription_id);

// to bulid checkout session and redirect user to pay in stripe website
    try {


        $checkout_session = $stripePayment->CreateCheckoutSession($subscription);
        //  dd($payment = $subscription->payments()->where("status", "=", "pending")->first());
            if (
                $payment = $subscription->payments()->where("status", "=", "pending")->first()
               )

        {

            $stripePayment->UpdatePayment($payment,[
               "amount"=>$subscription->price*100,
               "currency_code"=>"usd",
               "payment_gateway"=>"stripe",
               "gateway_reference_id"=>$checkout_session->id,
               "data"=>$checkout_session,
            ]);
        }else{

            $stripePayment->CreatePayment([
               "user_id"=>Auth::id(),
               "subscription_id"=>$subscription->id,
               "amount"=>$subscription->price*100,
               "currency_code"=>"usd",
               "payment_gateway"=>"stripe",
               "gateway_reference_id"=>$checkout_session->id,
               "data"=>$checkout_session,
            ]);
        }

        return redirect()->away($checkout_session->url);
}catch (Throwable $e){
            dd($e->getMessage());
            return back()->with("error", $e->getMessage());
}


// bulid custom payment  intent
    // try {


    //      // Create a PaymentIntent with amount and currency
    //     $paymentIntent = $stripe->paymentIntents->create([
    //     'amount' => $subscription->price*100,
    //     'currency' => 'usd',
    //     // In the latest version of the API, specifying the `automatic_payment_methods` parameter is optional because Stripe enables its functionality by default.
    //     'automatic_payment_methods' => [
    //         'enabled' => true,
    //     ],
    //     "metadata"=>[
    //         "subscription_id"=>$subscription->id
    //              ]
    //          ]);

    //      return [
    //     'clientSecret' => $paymentIntent->client_secret,
    //       ];

    // //    dd($output);
    //     } catch (Error $e) {

    //          return  response(['error' => $e->getMessage()],500);
    //         }


  }

public function success(Request $request){


            // $stripe = new \Stripe\StripeClient(config("services.stripe.secret"));
            // $result =$stripe->paymentIntents->retrieve(
            // $request->payment_intent ,
            // []
            // );

            //     $subscription =  Auth::user()->subscriptions()->findOrFail($result->metadata["subscription_id"]);
            //       $subscription->update([
            //         "status" => "confirmed",
            //         "expires_at"=>now()->addMonths($subscription->period)
            //     ]);


                   return redirect()->route("classrooms.index")->with("success", "The payment completed successfully");


 }
public function cancel(Request $request){
     return redirect()->route("classrooms.index")->with("error", "The payment failed, please try again");

 }





}
