<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.leaves.index', [
            'leaves' => Leave::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leaves.create', [
            'leave_types' => LeaveType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Leave::create([
            'user_id' => auth()->user()->id,
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'remarks' => $request->remarks,
            'status' => Leave::PENDING,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leaf)
    {
        return view('admin.leaves.edit', [
            'leave' => $leaf,
            'leave_types' => LeaveType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leave $leaf)
    {
        
        $request->validate([
            'leave_type_id' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $leaf->update([
            'leave_type_id' => $request->leave_type_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leaf)
    {
        $leaf->delete();
        return response()->json(["success" => "Leave Record Deleted Successfully"],201);
    }

    public function approve(Leave $leaf)
    {
        // dd($leaf);
        $leaf->update([
            'status' => Leave::APPROVED,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave approved successfully');
    }

    public function reject(Leave $leaf)
    {
        $leaf->update([
            'status' => Leave::REJECTED,
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave rejected successfully');
    }


}
