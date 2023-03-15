<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function attendance() {
        // dd(date('h:i A'));
        return view('admin.attendance', [
            'attendances' => Attendance::all(),
        ]);
    }

    public function timeIn() {
        $attendance = Attendance::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();

        if ($attendance) {
            return redirect()->back()->with('error', 'You have already time in');
        }

        Attendance::create([
            'user_id' => auth()->user()->id,
            'date' => date('Y-m-d'),
            'time_in' => date('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'You have successfully time in');
    }

    public function timeOut() {
        $attendance = Attendance::where('user_id', auth()->user()->id)->where('date', date('Y-m-d'))->first();

        if (!$attendance) {
            return redirect()->back()->with('error', 'You have not time in yet');
        }

        if ($attendance->time_out) {
            return redirect()->back()->with('error', 'You have already time out');
        }

        $attendance->update([
            'time_out' => date('H:i:s'),
        ]);

        return redirect()->back()->with('success', 'You have successfully time out');
    }
}
