<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Cluster;
use App\Models\Debit;
use App\Models\Delivery;
use App\Models\Ticket;
use App\Models\Unit;
use App\Models\User;
use App\Models\Visitation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $debits = 0;
        $clusters = 0;
        $units = 0;
        $guests = 0;
        $deliveries = 0;
        $tickets = 0;
        $announcement = null;


        if (auth()->user()->user_type == User::ADMIN) {
            $debits = Debit::count();
            $clusters = Cluster::count();
            $units = Unit::count();
            $guests = Visitation::count();
            $deliveries = Delivery::count();
            $tickets = Ticket::count();
        }else if(auth()->user()->user_type == User::USER) {
            $debits = $this->getAllUserDebits();
            $guests = Visitation::where('unit_id', auth()->user()->application->unit->id)->count();
            $deliveries = Delivery::where('unit_id', auth()->user()->application->unit->id)->count();
            $tickets = Ticket::where('user_id', auth()->user()->id)->count();
        }

        $latestAnnouncement  = Announcement::orderBy('created_at', 'desc')->first();

        // $billReadingDay = 15;
        // $dueDate = 7;

        // $currentDay = Carbon::now()->format('d');
        // if(intval($currentDay) < $billReadingDay)
        //     dd(Carbon::now()->AddD()->format('Y-m-d'));
        // else
        //     dd(Carbon::now()->format('Y-m-d');
        // // dd(Carbon::now()->addMonth()->format('Y-m-d'));
        return view('admin.dashboard', compact('debits', 'clusters', 'units', 'guests', 'deliveries', 'tickets',  'latestAnnouncement'));
    }

    private function getAllUserDebits()
    {
        $debits = Debit::where("show_in_portal", true)->get()->all();
        $all = [];

        foreach ($debits as $debit) {
            if ($debit->type == Debit::MOVE_IN) {
                if ($debit->application->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            } else if ($debit->type == Debit::MOVE_OUT) {
                if ($debit->moveOut->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            } else if ($debit->type == Debit::MONTHLY_DUE) {
                if ($debit->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            }
        }


        return count($all);
    }
}
