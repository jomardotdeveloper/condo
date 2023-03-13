<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    public function application() {
        return view('admin.application', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
            'gender' => $this->getEnumSelectOptions(config('enums.gender')),
            'marital_status' => $this->getEnumSelectOptions(config('enums.marital_status')),
        ]);
    }


    public function getResidentTypeOptions()
    {
        return [
            [
                'id' => 1,
                'name' => 'Unit Owner',
            ],
            [
                'id' => 2,
                'name' => 'Tenant',
            ],
        ];
    }
}
