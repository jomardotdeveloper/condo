<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.leave-types.index', [
            'leave_types' => LeaveType::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.leave-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        LeaveType::create($request->all());

        return redirect()->route('leave-types.index')->with('success', 'Leave type created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveType $leave_type)
    {
        return view('admin.leave-types.edit', [
            'leave_type' => $leave_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveType $leave_type)
    {
        $leave_type->update($request->all());

        return redirect()->route('leave-types.index')->with('success', 'Leave type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveType $leave_type)
    {
        $leave_type->delete();

        return response()->json(["success" => "Leave Type Record Deleted Successfully"],201);
    }
}
