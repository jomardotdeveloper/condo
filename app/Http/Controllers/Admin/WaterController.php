<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reading;
use App\Models\Unit;
use Illuminate\Http\Request;

class WaterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.waters.index', [
            'waters' => Reading::where('is_electricity', false)->get()->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.waters.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unit = Unit::find($request->unit_id);

        Reading::create([
            'unit_id' => $request->unit_id,
            'cluster_id' => $unit->cluster_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'reading' => $request->reading,
            'is_electricity' => false,
        ]);

        return redirect()->route('waters.index')->with('success', "Water reading for {$unit->unit_number} has been added.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reading $water)
    {
        return view('admin.waters.edit', [
            'water' => $water,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reading $water)
    {
        $unit = Unit::find($request->unit_id);

        $water->update([
            'unit_id' => $request->unit_id,
            'cluster_id' => $unit->cluster_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'reading' => $request->reading,
            'is_electricity' => false,
        ]);
        return redirect()->route('waters.index')->with('success', "Water reading for {$unit->unit_number} has been updated."); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reading $water)
    {
        $water->delete();
        return response()->json(["success" => "Water Record Deleted Successfully"],201);
    }
}
