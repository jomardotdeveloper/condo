<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.payments.index', [
            'payments' => Payment::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payments.create', [
            'invoices' => $this->getSelectOptions(Invoice::class, "invoice_number"),
            'payment_status' => $this->getEnumSelectOptions(config('enums.payment_status')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->createPayment($request, $request->invoice_id);
        return redirect()->route('admin.payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return view('admin.payments.show', [
            'payment' => $payment,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', [
            'payment' => $payment,
            'invoices' => $this->getSelectOptions(Invoice::class, "invoice_number"),
            'payment_status' => $this->getEnumSelectOptions(config('enums.payment_status')),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $this->updatePayment($request, $payment, $request->invoice_id);
        return redirect()->route('admin.payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(["success" => "Payment Record Deleted Successfully"],201);
    }
}
