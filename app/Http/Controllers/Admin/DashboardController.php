<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $billReadingDay = 15;
        // $dueDate = 7;

        // $currentDay = Carbon::now()->format('d');
        // if(intval($currentDay) < $billReadingDay)
        //     dd(Carbon::now()->AddD()->format('Y-m-d'));
        // else
        //     dd(Carbon::now()->format('Y-m-d');
        // // dd(Carbon::now()->addMonth()->format('Y-m-d'));
        return view('admin.dashboard');
    }
}
