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
                'type' => $type,
                'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            ]);
        else if($type == Invoice::MOVE_IN)
            return view('admin.invoices.create', [
                'type' => $type,
                'applications' => $this->getSelectOptions(
                    Application::class,
                    "full_name",
                    Application::where('status', Application::FOR_PAYMENT)->get()
                ),
            ]);
        else if($type == Invoice::MOVE_OUT)
            return view('admin.invoices.create', [
                'type' => $type,
                'move_outs' => $this->getSelectOptions(
                    MoveOut::class,
                    "full_name",
                    MoveOut::where('status', Application::FOR_PAYMENT)->get()->all(),
                )      
            ]);

        return view('admin.invoices.create', [
            'remarks' => true,
            'type' => $type,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createInvoice($request, Invoice::NORMAL);
        return redirect()->route('admin.invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', [
            'invoice' => $invoice,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}