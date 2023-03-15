<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reading;
use App\Models\Unit;
use Illuminate\Http\Request;

class ElectricController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.electrics.index', [
            'electrics' => Reading::where('is_electricity', true)->get()->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.electrics.create', [
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
            'is_electricity' => true,
        ]);

        return redirect()->route('electrics.index')->with('success', "Electric reading for {$unit->unit_number} has been added.");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reading $electric)
    {
        return view('admin.electrics.edit', [
            'electric' => $electric,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reading $electric)
    {
        
        $unit = Unit::find($request->unit_id);

        $electric->update([
            'unit_id' => $request->unit_id,
            'cluster_id' => $unit->cluster_id,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'reading' => $request->reading,
            'is_electricity' => true,
        ]);

        return redirect()->route('electrics.index')->with('success', "Electric reading for {$unit->unit_number} has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reading $electric)
    {
        $unit = Unit::find($electric->unit_id);
        $electric->delete();

        return response()->json(["success" => "Electricity Reading Record Deleted Successfully"],201);
    }
}
