<?php

namespace App\Http\Traits;


use App\Models\Debit;

trait InvoiceTrait {
    public function createDebit($request, $type) {
        $values = $request->all();
        $values['type'] = $type;
        $debit = Debit::create($values);
        return $debit;
    }

    public function updateDebit ($request, $debit) {
        $debit->update($request->all());
        return $debit;
    }

    
}