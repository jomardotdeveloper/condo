<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Unit;
use App\Models\User;
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
        // THIS IS A COMMENT
        $guests = Visitation::all();
        if(auth()->user()->user_type == User::USER) {
            $guests = Visitation::where('unit_id', auth()->user()->application->unit_id)->get()->all();
        }

        if(isset($_GET['today'])) {
            $guests = Visitation::where('unit_id', auth()->user()->application->unit_id)->whereDate('expected_arrival_date', date('Y-m-d'))->get()->all();
        }

        return view('admin.visitors.index', [
            'guests' => $guests,
            'deliveries' => Delivery::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = $this->getSelectOptions(Unit::class, "unit_number");

        if(auth()->user()->user_type == User::USER) {
            $units = $this->getSelectOptions(Unit::class, "unit_number", Unit::where('id', auth()->user()->application->unit_id)->get());
        }

        return view('admin.visitors.create', [
            'units' => $units,
            'valid_ids' => $this->getEnumSelectOptions(Visitation::VALID_IDS),
            'visitors' => $this->getSelectOptions(Visitor::class, "email"),
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
        $values['is_approved'] = $request->is_approved == "1"? true : false;
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
        $units = $this->getSelectOptions(Unit::class, "unit_number");

        if(auth()->user()->user_type == User::USER) {
            $units = $this->getSelectOptions(Unit::class, "unit_number", Unit::where('id', auth()->user()->application->unit_id)->get());
        }
        return view('admin.visitors.edit', [
            'guest' => $visitation,
            'units' => $units,
            'valid_ids' => $this->getEnumSelectOptions(Visitation::VALID_IDS),
            'visitors' => $this->getSelectOptions(Visitor::class, "email"),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $visitation = Visitation::find($id);
        $values = $request->all();
        $values['is_approved'] = $request->is_approved == "1"? true : false;
        $visitation->update($values);
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
