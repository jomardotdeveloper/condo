<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.units.index', [
            'units' => Unit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.units.create', [
            'clusters' => $this->getSelectOptions(Cluster::class),
            'unit_types' => $this->getEnumSelectOptions(config('enums.unit_types')),
            'unit_status' => $this->getEnumSelectOptions(config('enums.unit_status')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Unit::create([
            'unit_number' => $request->unit_number,
            'cluster_id' => $request->cluster_id,
            'unit_tower' => $request->unit_towers,
            'unit_floor' => $request->unit_floor,
            'unit_room' => $request->unit_room,
            'unit_type' => $request->unit_type,
            'floor_area' => $request->floor_area,
            'unit_association_fee' => $request->unit_association_fee,
            'unit_parking_fee' => $request->unit_parking_fee,
            'status' => $request->status,
        ]);

        return redirect()->route('units.index')->with(["success" => "Unit has been created."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        return view('admin.units.show', [
            'unit' => $unit,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('admin.units.edit', [
            'unit' => $unit,
            'clusters' => $this->getSelectOptions(Cluster::class),
            'unit_types' => $this->getEnumSelectOptions(config('enums.unit_types')),
            'unit_status' => $this->getEnumSelectOptions(config('enums.unit_status')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $unit->update([
            'unit_number' => $request->unit_number,
            'cluster_id' => $request->cluster_id,
            'unit_tower' => $request->unit_towers,
            'unit_floor' => $request->unit_floor,
            'unit_room' => $request->unit_room,
            'unit_type' => $request->unit_type,
            'floor_area' => $request->floor_area,
            'unit_association_fee' => $request->unit_association_fee,
            'unit_parking_fee' => $request->unit_parking_fee,
            'status' => $request->status,
        ]);

        return redirect()->route('units.index')->with(["success" => "Unit has been updated."]);        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return response()->json(["success" => "Unit Record Deleted Successfully"],201);
    }
}
