<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaymentTrait;
use App\Models\Debit;
use Illuminate\Http\Request;

class DebitController extends Controller
{
    use PaymentTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.invoices.index', [
            'debits' => $this->getAllUserDebits(),
        ]);
    }

    private function getAllUserDebits()
    {
        $debits = Debit::where("show_in_portal", true)->get()->all();
        $all = [];

        foreach ($debits as $debit) {
            if ($debit->type == Debit::MOVE_IN) {
                if ($debit->application->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            } else if ($debit->type == Debit::MOVE_OUT) {
                if ($debit->moveOut->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            } else if ($debit->type == Debit::MONTHLY_DUE) {
                if ($debit->user_id == auth()->user()->id) {
                    $all[] = $debit;
                }
            }
        }


        return $all;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function storePayment(Request $request) {
        $this->createSubscription($request);
        return redirect()->route('user-debits.index')->with('success', 'Your payment is being processed. Please wait for the confirmation.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $debit = Debit::find($id);
        // dd($debit);
        return view('user.invoices.show', compact('debit'));
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
