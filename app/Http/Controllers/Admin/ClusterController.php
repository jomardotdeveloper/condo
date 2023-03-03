<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clusters.index', [
            'clusters' => Cluster::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clusters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'unit_towers' => 'nullable',
            'reading_day' => 'required',
            'due_date' => 'required',
        ]);

        Cluster::create([
            'name' => $request->name,
            'unit_towers' => $request->unit_towers,
            'reading_day' => $request->reading_day,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('clusters.index')->with('success', 'Cluster created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cluster $cluster)
    {
        return view('admin.clusters.edit', [
            'cluster' => $cluster,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cluster $cluster)
    {
        $request->validate([
            'name' => 'required',
            'unit_towers' => 'nullable',
            'reading_day' => 'required',
            'due_date' => 'required',
        ]);

        $cluster->update([
            'name' => $request->name,
            'unit_towers' => $request->unit_towers,
            'reading_day' => $request->reading_day,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('clusters.index')->with('success', 'Cluster updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        $cluster->delete();

        return response()->json(["success" => "Cluster Record Deleted Successfully"],201);
    }

    public function getUnitTowers(Cluster $cluster)
    {
        $unit_towers = $cluster->unit_towers_array;
        return response()->json($unit_towers);
        // return response()->json(["haha"]);
    }
}
