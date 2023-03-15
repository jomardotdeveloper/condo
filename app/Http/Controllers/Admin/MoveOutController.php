<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\InvoiceTrait;
use App\Http\Traits\PaymentTrait;
use App\Models\Application;
use App\Models\Debit;
use App\Models\MoveOut;
use App\Models\Unit;
use Illuminate\Http\Request;

class MoveOutController extends Controller
{
    use InvoiceTrait, PaymentTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status_ids = array_keys(config('enums.application_status'));

        if(!isset($_GET['status'])) {
            return $this->redirectTo404();
        } else if(!in_array($_GET['status'], $status_ids)) {
            return $this->redirectTo404();
        }

        $title =config('enums.application_status')[$_GET['status']];

        $move_outs = MoveOut::where('status', $_GET['status'])->get()->all();
        return view('admin.move-outs.index', compact('move_outs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.move-outs.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'move_out_date' => 'required',
            'unit_id' => 'required',
            'resident_type' => 'required',
        ]);

        $values = $request->all();

        if(array_key_exists("item_quantities" , $values))
            $values["item_quantities"] = implode(",", $values["item_quantities"]);
        if(array_key_exists("item_names" , $values))
            $values["item_names"] = implode(",", $values["item_names"]);
        if(array_key_exists("item_descriptions" , $values))
            $values["item_descriptions"] = implode(",", $values["item_descriptions"]);
        if(array_key_exists("item_remarks" , $values))
            $values["item_remarks"] = implode(",", $values["item_remarks"]);
        if(array_key_exists("charges_checklists" , $values))
            $values["charges_checklists"] = implode(",", $values["charges_checklists"]);

        $values["status"] = 1;

        MoveOut::create($values);

        return redirect()->route('move-outs.index', ['status' => 1])->with('success', 'Move Out Application has been created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MoveOut $move_out)
    {
        return view('admin.move-outs.show', [
            'move_out' => $move_out,
            'resident_types' => $this->getResidentTypeOptions(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MoveOut $move_out)
    {
        return view('admin.move-outs.edit', [
            'move_out' => $move_out,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MoveOut $move_out)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'move_out_date' => 'required',
            'unit_id' => 'required',
            'resident_type' => 'required',
        ]);


        $values = $request->all();
        if(array_key_exists("item_quantities" , $values))
            $values["item_quantities"] = implode(",", $values["item_quantities"]);
        else
            $values["item_quantities"] = null;

        if(array_key_exists("item_names" , $values))
            $values["item_names"] = implode(",", $values["item_names"]);
        else
            $values["item_names"] = null;
        if(array_key_exists("item_descriptions" , $values))
            $values["item_descriptions"] = implode(",", $values["item_descriptions"]);
        else
            $values["item_descriptions"] = null;
        if(array_key_exists("item_remarks" , $values))
            $values["item_remarks"] = implode(",", $values["item_remarks"]);
        else
            $values["item_remarks"] = null;
        if(array_key_exists("charges_checklists" , $values))
            $values["charges_checklists"] = implode(",", $values["charges_checklists"]);
        else
            $values["charges_checklists"] = null;

        $move_out->update($values);

        return redirect()->route('move-outs.index', ['status' => 1])->with('success', 'Move Out Application has been updated successfully.');
         
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function storeInvoice(Request $request) {
        $this->createDebit($request, Debit::MOVE_OUT);
        $move_out = MoveOut::find($request->move_out_id);
        $move_out->status = Application::FOR_PAYMENT;
        $move_out->save();
        return redirect()->route('move-outs.index', ['status' => Application::FOR_PAYMENT])->with('success', 'Invoice created successfully. Move Out status has been changed to "For Payment".');
    }

    public function storePayment(Request $request) {
        $move_out = MoveOut::find($request->move_out_id);
        $this->createSubscription($request);
        $move_out->status = Application::LOBBY_GUARD;
        $move_out->save();
        return redirect()->route('applications.index', ['status' => Application::LOBBY_GUARD])->with('success', 'Payment created successfully. Move out status has been changed to "Lobby Guard".');
    }

    public function getResidentTypeOptions()
    {
        return [
            [
                'id' => 1,
                'name' => 'Unit Owner',
            ],
            [
                'id' => 2,
                'name' => 'Tenant',
            ],
        ];
    }
}
