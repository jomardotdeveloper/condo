<?php

namespace App\Http\Traits;


use App\Models\Subscription;
use Illuminate\Support\Facades\Storage;

trait PaymentTrait {
    use EntryTrait;
    public function createSubscription($request) {
        $values = $request->all();

        if ($request->hasFile('proof_of_payment_src')) {
            $values['proof_of_payment_src'] = $this->uploadFile($request, 'proof_of_payment_src', 'proof_of_payment');
        } 
        
        $subscription =  Subscription::create($values);
        $this->createEntryFromPayment($subscription, true);
        return $subscription;
    }

    public function uploadFile($request, $file_name, $file_path) {
        $path = Storage::putFile("public/" . $file_path, $request->file($file_name));
        $path = Storage::url($path);
        return $path;
    }

    
}