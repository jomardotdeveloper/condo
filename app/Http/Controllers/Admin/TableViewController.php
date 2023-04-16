<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Unit;
use App\Models\Visitation;
use App\Models\Visitor;
use Illuminate\Http\Request;

class TableViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tablets.index', [
            'guests' => Visitation::all(),
            'deliveries' => Delivery::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tablets.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'valid_ids' => $this->getEnumSelectOptions(Visitation::VALID_IDS),
            'visitors' => $this->getSelectOptions(Visitor::class, "full_name"),
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
