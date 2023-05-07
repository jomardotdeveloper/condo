<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        $validated = $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($validated, true)) {
            $request->session()->regenerate();
            return redirect()->intended("/admin/dashboard");
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route("login");
    }
    
    public function application() {
        return view('admin.application', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
            'gender' => $this->getEnumSelectOptions(config('enums.gender')),
            'marital_status' => $this->getEnumSelectOptions(config('enums.marital_status')),
            'administrative_officers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::ADMINISTRATIVE_OFFICER)->get()
            ),
            'finance_departments' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::FINANCE_DEPARTMENT)->get()
            ),
            'executive_ao_complex_managers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::EXECUTIVE_AO_COMPLEX_MANAGER)->get()
            ),
            'security_officers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::SECURITY_OFFICER)->get()
            ),
        ]);
    }

    public function vendorApplication() {
        return view('admin.vendor-application', [
            'forms' => $this->getEnumSelectOptions(Dealer::FORM_OF_ORGANIZATION),
            'status' => $this->getEnumSelectOptions(Dealer::STATUS),
            'type_checklists' => Dealer::TYPE_CHECKLISTS,
            'category_checklists' => Dealer::CATEGORY_CHECKLISTS,
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
