<?php

namespace App\Http\Traits;

use App\Models\Account;
use App\Models\Entry;
use App\Models\Setting;

trait EntryTrait {
    public function createEntry($request) {
        $entry = Entry::create($request->all());
        return $entry;
    }


    public function deleteEntry() {

    }

    public function updateEntry($request, $entry) {
        $entry->update($request->all());
        return $entry;
    }


    public function createEntryFromPayment($payment, $is_in = false, $account_id = null) {
        $values = [];


        if($account_id == null) {
            $setting = null;
            
            if($is_in)
                $setting  = Setting::where('key', 'account.in')->first();
            else
                $setting  = Setting::where('key', 'account.out')->first();

            if ($setting) {
                $values['account_id'] = Account::where("code", $setting->value)->first()->id;
            } else {
                $values['account_id'] = Account::where('is_in', $is_in )->first()->id;
            }
        }

        $entry = Entry::create([
            'account_id' => $values['account_id'],
            'source_document' => $payment->formatted_id,
            'amount' => $payment->amount,
            'subscription_id' => $payment->id,
        ]);

        return $entry;
    } 
    
}