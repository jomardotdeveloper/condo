<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Debit;
use App\Models\MoveOut;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DebitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $response = Http::post('https://api.semaphore.co/api/v4/messages', [
        //     'apikey' => 'e31d0a06cbaeee5cedfd66e3d9922f11',
        //     'number' => "09776229783",
        //     'message' => "Sample",
        //     'sendername' => 'SEMAPHORE'
        // ]);
        // $response = Http::post('https://api.semaphore.co/api/v4/messages', [
        //     'apikey' => 'e31d0a06cbaeee5cedfd66e3d9922f11',
        //     'number' => '09776229783',
        //     'message' => "Sample message",
        //     'sendername' => 'SEMAPHORE'
        // ]);
        // dd($response);
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
        $user = null;
        if(isset($_GET['user_id']))
            $user = User::find($_GET['user_id']);

        return view('admin.debits.create', [
            'user' => $user,
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
            'users' => $this->getOwnerSelectOptions(),
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

        $values = $request->all();
        if(intval($request->type) == Debit::MONTHLY_DUE)
        {
            $values['show_in_portal'] = $request->show_in_portal == '1' ? true : false;
            $values['customer_name'] = User::find($request->user_id)->application->full_name;
        }
            

        Debit::create($values);

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
        $users  = $this->getOwnerSelectOptions();
        return view('admin.debits.edit', compact('debit', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Debit $debit)
    {

        $values = $request->all();
        $values["show_in_portal"] = $request->show_in_portal == '1' ? true : false;
        $debit->update($values);

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
