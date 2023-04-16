<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    

    use AuthorizesRequests, ValidatesRequests;

    public function getSelectOptions($model, $display_name="name", $col_filter = null)
    {
        $collections = $model::all();

        if($col_filter != null) {
            $collections = $col_filter;
        }

        $options = $collections->map(function ($obj, $key) use ($display_name) {
            return [
                "id" => $obj['id'],
                "name" => $obj[$display_name]
            ];
        });
        return $options;
    }

    public function getOwnerSelectOptions ( ) {
        $options = [];

        $users = User::where('user_type', User::USER)->get();

        foreach ($users as $user) {
            $options[] = [
                "id" => $user->id,
                "name" => $user->application->full_name
            ];
        }

        return $options;
    }

    public function getEnumSelectOptions($enum)
    {
        $options = [];
        foreach ($enum as $key => $value) {
            $options[] = [
                "id" => $key,
                "name" => $value
            ];
        }
        return $options;
    }

    public function createUser($request, $user_type)
    {
        $user = User::create([
            'email' => $request->email,
            'user_type' => $user_type,
            'password' => Hash::make($request->password),
        ]);
        return $user;
    }

    public function updateUser($request, $user)
    {
        $values = [
            'email' => $request->email
        ];

        if ($request->password) {
            $values['password'] = Hash::make($request->password);
        }

        $user->update($values);
        return $user;
    }

    public function redirectTo404()
    {
        return redirect()->route('error.not-found');
    }

    public function redirectTo503()
    {
        return redirect()->route('error.503');
    }

    // INVOICE


    public function createInvoice($request, $type) {

        if($type == Invoice::MOVE_IN)
        {
            $lines = [
                [
                    'id' => 1,
                    'label' => $request->get("label"),
                    'amount' => $request->get("amount"),
                ]
            ];
            
            $invoice = Invoice::create([
                'application_id' => $request->application_id,
                'due_date' => date('Y-m-d'),
                'lines' => json_encode($lines),
            ]);
            
        }else if ($type == Invoice::NORMAL) {
            $invoice = Invoice::create([
                'due_date' => $request->due_date,
                'lines' => $request->lines,
                'remarks' => $request->remarks,
            ]);
        }
            
        return $invoice;
    }

    public function createPayment($request, $invoice_id) {
        $payment = Payment::create([
            'invoice_id' => $invoice_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference,
            'payment_status' => $request->payment_status,
        ]);


        return $payment;
    }

    public function updatePayment($request, $payment, $invoice_id) {
        $payment->update([
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_reference' => $request->payment_reference,
            'payment_status' => $request->payment_status,
            'invoice_id' => $invoice_id,
        ]);
        
        return $payment;
    }


    public function uploadFile($request, $file_name, $file_path) {
        $path = Storage::putFile("public/" . $file_path, $request->file($file_name));
        $path = Storage::url($path);
        return $path;
    }

}
