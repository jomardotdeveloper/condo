<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{

    public function maintenance()
    {
        return view('admin.web-errors.503');
    }

    public function notFound()
    {
        return view('admin.web-errors.404');
    }

    public function forbidden()
    {
        return view('welcome');
    }
}
