<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\MoveIn;
use App\Models\Unit;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
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

        $applications = Application::where('status', $_GET['status'])->get()->all();
        return view('admin.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.applications.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $values = $request->all();


        
        if(array_key_exists("unit_owner_checklists" , $values))
            $values["unit_owner_checklists"] = implode(",", $values["unit_owner_checklists"]);

        if(array_key_exists("unit_tenant_checklists" , $values))
            $values["unit_tenant_checklists"] = implode(",", $values["unit_tenant_checklists"]);

        if(array_key_exists("charges_checklists" , $values))
            $values["charges_checklists"] = implode(",", $values["charges_checklists"]);

        if(array_key_exists("charges_remarks" , $values))
            $values["charges_remarks"] = implode(",", $values["charges_remarks"]);

        if(array_key_exists("signature_checklists" , $values))
            $values["signature_checklists"] = implode(",", $values["signature_checklists"]);

        


        $move_in = MoveIn::create($values);

        $application = Application::create([
            'first_name' => $values['first_name'],
            'last_name' => $values['last_name'],
            'middle_name' => $values['middle_name'],
            'is_owner' => $values['resident_type'] == "1" ? true : false,
            'unit_id' => $values['unit_id'],
            'move_in_id' => $move_in->id,
            'status' => 1,
        ]);

        return redirect()->route('applications.index', ['status' => 1])->with('success', 'Application created successfully.');
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
