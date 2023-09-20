<?php
namespace App\Actions;

use App\Models\Subscription;

class CreateSubscriptionAction {

    // this is importent for documention of code
    /**
     * Summary of __invoke
     * @param array $data
     * @return \App\Models\Subscription
     */
    public function __invoke(array $data) :Subscription {

       return Subscription::forceCreate($data);
    }
}
