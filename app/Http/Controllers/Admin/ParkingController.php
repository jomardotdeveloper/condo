<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cluster;
use App\Models\Parking;
use App\Models\Unit;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.parkings.index', [
            'parkings' => Parking::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parkings.create', [
            'clusters' => $this->getSelectOptions(Cluster::class),
            'users' => $this->getOwnerSelectOptions(),
            'status' =>$this->getEnumSelectOptions( Parking::STATUS),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Parking::create($request->all());

        return redirect()->route('parkings.index')->with(["success" => "Parking has been created."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Parking $parking)
    {
        return view('admin.parkings.show', [
            'parking' => $parking,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Parking $parking)
    {
        return view('admin.parkings.edit', [
            'parking' => $parking,
            'clusters' => $this->getSelectOptions(Cluster::class),
            'users' => $this->getOwnerSelectOptions(),
            'status' =>$this->getEnumSelectOptions( Parking::STATUS),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parking $parking)
    {
        $parking->update($request->all());

        return redirect()->route('parkings.index')->with(["success" => "Parking has been updated."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Parking $parking)
    {
        $parking->delete();
        return response()->json(["success" => "Parking Record Deleted Successfully"],201);
    }
}
