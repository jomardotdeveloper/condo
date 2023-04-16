<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Unit;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.deliveries.index', [
            'deliveries' => Delivery::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.deliveries.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Delivery::create($request->all());
        return redirect()->route('deliveries.index')->with('success', 'Delivery created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        return view('admin.deliveries.show', [
            'delivery' => $delivery,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        return view('admin.deliveries.edit', [
            'delivery' => $delivery,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        $delivery->update($request->all());
        return redirect()->route('deliveries.index')->with('success', 'Delivery updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return response()->json(["success" => "Delivery Record Deleted Successfully"],201);
    }
}
