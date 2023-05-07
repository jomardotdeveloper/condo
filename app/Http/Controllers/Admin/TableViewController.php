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
            'guests' => Visitation::where("is_approved", true)->get(),
            'deliveries' => Delivery::where("is_approved", true)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // dd();
        
        return view('admin.tablets.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'valid_ids' => $this->getEnumSelectOptions(Visitation::VALID_IDS),
            'visitors' => $this->getSelectOptions(Visitor::class, "email"),
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
            'emails' => Visitor::all()->pluck('email', 'id')->toArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $is_visitation = $request->type == "visitation";
        // dd($request->all());
        if($is_visitation) {
            $visitor = null;
            if (!$request->is_returnee) {
                $request->validate([
                    'email' => 'required|email|unique:visitors'
                ]);
                $values = $request->all();
                $visitor = Visitor::create($values);
            } else {
                $visitor = Visitor::find($request->visitor_id);
            }
            // dd($visitor->id);
            $values = $request->all();
            $values['visitor_id'] = $visitor->id;
            $values['is_approved'] = true;
            $values['expected_arrival_date'] = date('Y-m-d H:i:s');
            // dd($values);
            Visitation::create($values);
            return redirect()->route('tablets.index', ['type' => 'visitor'])->with('success', 'Guest created successfully.');
        } else {
            $values = $request->all();
            $values['is_approved'] = true;
            $values['expected_arrival_date'] = date('Y-m-d H:i:s');
            Delivery::create($values);
            return redirect()->route('tablets.index', ['type' => 'delivery'])->with('success', 'Delivery created successfully.');
        }
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
