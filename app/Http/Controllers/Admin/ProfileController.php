<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile() {
        return view('admin.profile', [
            'employee' => auth()->user()->employee,
        ]);
    }

    public function changePersonalInformation(Request $request) {   
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ]);

        $employee = auth()->user()->employee;

        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'middle_name' => $request->middle_name,
        ]);

        auth()->user()->update([
            'email' => $request->email,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Personal information updated successfully');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        if(!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors([
                'old_password' => 'Incorrect old password',
            ]);
        }


        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully');
    }

    
}
