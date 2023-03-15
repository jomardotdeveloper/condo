<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Debit;
use App\Models\MoveOut;
use App\Models\Unit;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.debits.index', [
            'debits' => Debit::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type_ids = array_keys(config('enums.debit_types'));


        if(!isset($_GET['type'])) {
            return $this->redirectTo404();
        } else if(!in_array($_GET['type'], $type_ids)) {
            return $this->redirectTo404();
        }


        return view('admin.debits.create', [
            'type' => $_GET['type'],
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'applications' => $this->getSelectOptions(
                Application::class,
                "full_name",
                Application::where('status', Application::NEW_APPLICATION)->get()
            ),
            'move_outs' => $this->getSelectOptions(
                MoveOut::class,
                "full_name",
                MoveOut::where('status', Application::NEW_APPLICATION)->get()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        if(intval($request->type) == Debit::MOVE_IN){
            $application = Application::find($request->application_id);
            $application->status = Application::FOR_PAYMENT;
            $application->save();
        }
        else if(intval($request->type) == Debit::MOVE_OUT) {
            $move_out = MoveOut::find($request->move_out_id);
            $move_out->status = Application::FOR_PAYMENT;
            $move_out->save();
        }

        Debit::create($request->all());

        return redirect()->route('debits.index')->with('success', 'Invoice created successfully.');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Debit $debit)
    {
        return view('admin.debits.show', compact('debit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Debit $debit)
    {
        return view('admin.debits.edit', compact('debit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debit $debit)
    {
        $debit->update($request->all());

        return redirect()->route('debits.index')->with('success', 'Invoice updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Debit $debit)
    {
        if($debit->type == Debit::MOVE_IN){
            $application = Application::find($debit->application_id);
            $application->status = Application::NEW_APPLICATION;
            $application->save();
        }
        else if($debit->type == Debit::MOVE_OUT) {
            $move_out = MoveOut::find($debit->move_out_id);
            $move_out->status = Application::NEW_APPLICATION;
            $move_out->save();
        }

        $debit->delete();

        return response()->json(["success" => "Invoice Record Deleted Successfully"],201);
    }
}
