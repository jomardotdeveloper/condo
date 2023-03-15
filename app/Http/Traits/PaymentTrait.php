<?php

namespace App\Http\Traits;


use App\Models\Subscription;

trait PaymentTrait {
    use EntryTrait;
    public function createSubscription($request) {
        $values = $request->all();
        $subscription =  Subscription::create($values);
        $this->createEntryFromPayment($subscription, true);
        return $subscription;
    }

    
}