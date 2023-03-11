<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request){
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
