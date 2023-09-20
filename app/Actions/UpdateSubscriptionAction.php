<?php
namespace App\Actions;

use App\Models\Subscription;

class UpdateSubscriptionAction {

    public function __invoke(Subscription $lastSubscription, array $data) :Subscription {

       $lastSubscription->update($data);

        return $lastSubscription;
    }
}
