<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Invoice;
use App\Models\MoveOut;
use App\Models\Unit;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.invoices.index', [
            'invoices' => Invoice::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!isset($_GET['type']))
            return view('admin.invoices.create', [
                'remarks' => true
            ]);
        
        
        $type = intval($_GET['type']);

        if($type == Invoice::MONTHLY_DUES)
            return view('admin.invoices.create', [
                'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            ]);
        else if($type == Invoice::MOVE_IN)
            return view('admin.invoices.create', [
                'applications' => $this->getSelectOptions(
                    Application::class,
                    "full_name",
                    Application::where('status', Application::FOR_PAYMENT)->get()->all()
                ),
            ]);
        else if($type == Invoice::MOVE_OUT)
            return view('admin.invoices.create', [
                'move_outs' => $this->getSelectOptions(
                    MoveOut::class,
                    "full_name",
                    MoveOut::where('status', Application::FOR_PAYMENT)->get()->all(),
                )      
            ]);

        return view('admin.invoices.create', [
                'remarks' => true
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->all();

        if(array_key_exists("lines", $values))
            $values["lines"] = json_encode($values["lines"]);

        Invoice::create($values);

        return redirect()->route('admin.invoices.index');
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