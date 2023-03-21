<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.positions.index', [
            'positions' => Position::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Position::create([
            'name' => $request->name,
        ]);

        return redirect()->route('positions.index')->with('success', 'Position created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        return view('admin.positions.edit', [
            'position' => $position,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $position->update([
            'name' => $request->name,
        ]);

        return redirect()->route('positions.index')->with('success', 'Position updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        if(!$position->is_deletable)
            return response()->json(["error" => "Position Record Cannot Be Deleted"],201);
        
        $position->delete();

        return response()->json(["success" => "Position Record Deleted Successfully"],201);
    }
}
