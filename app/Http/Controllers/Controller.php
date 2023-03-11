<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

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


    public function createInvoice($request) {
        $invoice = Invoice::create([
            'user_id' => $request->user_id,
            'unit_id' => $request->unit_id,
            'application_id' => $request->application_id,
            'due_date' => $request->due_date,
            'lines' => $request->lines,
        ]);
        return $invoice;
    }
}
