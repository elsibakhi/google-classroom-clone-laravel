<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

 class StripePayment {


        public function CreateCheckoutSession (Subscription $subscription) :object {


        $stripe = App::make(StripeClient::class);
       return $stripe->checkout->sessions->create([
      'line_items' => [[
        'price_data' => [
          'currency' => 'usd',
          'product_data' => [
            'name' => $subscription->plan->name,
          ],
          'unit_amount' => $subscription->plan->price*100,
        ],
        'quantity' => $subscription->period,
      ]],
      'metadata' =>[
        "subscription_id"=>$subscription->id
      ],
      "client_reference_id" => $subscription->id,
      'mode' => 'payment',
      'success_url' => route("payments.success"),
      'cancel_url' => route("payments.cancel"),
    ]);

        }

        public function CreatePayment(array $data){

        Payment::forceCreate($data);
    }
        public function UpdatePayment(Payment $payment ,array $data){

         $payment->forceFill($data)->save();
    }


 }
