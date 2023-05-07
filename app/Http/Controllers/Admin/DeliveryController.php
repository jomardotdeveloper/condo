<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        if(auth()->user()->user_type == User::USER) {
            $deliveries = Delivery::where('unit_id', auth()->user()->application->unit_id)->get()->all();
        }

        if(isset($_GET['today'])) {
            $deliveries = Delivery::where('unit_id', auth()->user()->application->unit_id)->whereDate('expected_arrival_date', date('Y-m-d'))->get()->all();
            // dd($deliveries);
        }
        return view('admin.deliveries.index', [
            'deliveries' => $deliveries,
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
        return view('admin.deliveries.create', [
            'units' => $units,
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->all();
        $values['is_approved'] = $request->is_approved == "1"? true : false;
        Delivery::create($values);
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
        $units = $this->getSelectOptions(Unit::class, "unit_number");

        if(auth()->user()->user_type == User::USER) {
            $units = $this->getSelectOptions(Unit::class, "unit_number", Unit::where('id', auth()->user()->application->unit_id)->get());
        }
        
        return view('admin.deliveries.edit', [
            'delivery' => $delivery,
            'units' => $units,
            'types' => $this->getEnumSelectOptions(Delivery::TYPE),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        $values = $request->all();
        $values['is_approved'] = $request->is_approved == "1"? true : false;
        $delivery->update($values);
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
