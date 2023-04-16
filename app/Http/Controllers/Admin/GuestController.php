<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Unit;
use App\Models\Visitation;
use App\Models\Visitor;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.visitors.index', [
            'guests' => Visitation::all(),
            'deliveries' => Delivery::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.visitors.create', [
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
        $visitor = null;
        if (!$request->is_returnee) {
            $visitor = Visitor::create($request->all());
        } else {
            $visitor = Visitor::find($request->visitor_id);
        }
        // dd($visitor->id);
        $values = $request->all();
        $values['visitor_id'] = $visitor->id;
        // dd($values);
        Visitation::create($values);
        return redirect()->route('guests.index')->with('success', 'Guest created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitation = Visitation::find($id);
        return view('admin.visitors.show', [
            'guest' => $visitation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitation = Visitation::find($id);
        return view('admin.visitors.edit', [
            'guest' => $visitation,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'valid_ids' => $this->getEnumSelectOptions(Visitation::VALID_IDS),
            'visitors' => $this->getSelectOptions(Visitor::class, "full_name"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visitation = Visitation::find($id);
        $visitation->update($request->all());
        return redirect()->route('guests.index')->with('success', 'Guest updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visitation = Visitation::find($id);
        $visitation->delete();
        return response()->json(["success" => "Visitation Record Deleted Successfully"],201);
    }
}
