<?php

namespace App\Http\Controllers\webhooks;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class StripeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request , StripeClient $stripe)
    {





$endpoint_secret = 'whsec_0e0c916e9e6f48b8e31a311f6d8292777ce2ce48307eb9a5c307382ecea6bddd';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
  $event = \Stripe\Webhook::constructEvent(
    $payload, $sig_header, $endpoint_secret
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
            return response('', 400);
} catch(\Stripe\Exception\SignatureVerificationException $e) {
  // Invalid signature
            return response('', 400);
}

// Handle the event
switch ($event->type) {
  case 'checkout.session.async_payment_failed':
    $session = $event->data->object;
                break;
  case 'checkout.session.async_payment_succeeded':
    $session = $event->data->object;
     break;
  case 'checkout.session.completed':
    $session = $event->data->object;
               $payment = Payment::where("gateway_reference_id", $session->id)->first();
                $payment->forceFill(["gateway_reference_id"=> $session->payment_intent])->save();
     break;
  case 'checkout.session.expired':
    $session = $event->data->object;
     break;
  case 'payment_intent.amount_capturable_updated':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.canceled':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.created':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.partially_funded':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.payment_failed':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.processing':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.requires_action':
    $paymentIntent = $event->data->object;
     break;
  case 'payment_intent.succeeded':
    $paymentIntent = $event->data->object;
      $payment = Payment::where("gateway_reference_id", $paymentIntent->id)->first();
                DB::transaction(function () use ($payment) {

                    $payment->forceFill(["status" => "completed"])->save();
              $subscription = $payment->subscription;

                  $subscription->update([
                    "status" => "active",
                    "expires_at"=>now()->addMonths($subscription->period)
                ]);
                });
     break;
  // ... handle other event types
  default:

}

        return response('', 200);
    }
}
