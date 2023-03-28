<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Renovation;
use App\Models\Setting;
use App\Models\Unit;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class RenovationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $renovations = Renovation::where('status', $_GET['status'])->get();

        if(auth()->user()->user_type == User::USER) {
            $renovations = Renovation::where('user_id', '=', auth()->user()->id)->where('status', $_GET['status'])->get();
        }

        $title =config('enums.application_status')[$_GET['status']];

        return view('permits.renovations.index', compact('renovations', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('permits.renovations.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'users' => $this->getSelectOptions(User::class, "email",User::where('user_type', User::USER)->get()),
            'administrative_officers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::ADMINISTRATIVE_OFFICER)->get()
            ),
            'executive_ao_complex_managers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::EXECUTIVE_AO_COMPLEX_MANAGER)->get()
            ),
            'property_engineers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::PROPERTY_ENGINEER)->get()
            ),
            'vendors' => $this->getSelectOptions(
                Vendor::class, 
                "company_name", 
                Vendor::where('is_contractor', true)->get()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required',
            'user_id' => 'required',
        ]);

        $values = $request->all();

        if(array_key_exists("requirement_checklists" , $values))
            $values["requirement_checklists"] = implode(",", $values["requirement_checklists"]);

        if(array_key_exists("refundable_checklists" , $values))
            $values["refundable_checklists"] = implode(",", $values["refundable_checklists"]);

        if(array_key_exists("workers_identification_checklists" , $values))
            $values["workers_identification_checklists"] = implode(",", $values["workers_identification_checklists"]);

        if(array_key_exists("prior_checklists" , $values))
            $values["prior_checklists"] = implode(",", $values["prior_checklists"]);

        if(array_key_exists("construction_bond_checklists" , $values))
            $values["construction_bond_checklists"] = implode(",", $values["construction_bond_checklists"]);

        if($values["cleared_by_id"] == null){
            $setting = Setting::where('key', 'administrative.officer')->first();
            $user = User::where('email', $setting->value)->first();
            $values["cleared_by_id"] = $user->employee->id;
            // ADMINISTRATIVE OFFICER
        }

        if($values["check_by_id"] == null){
            $setting = Setting::where('key', 'property.engineer')->first();
            $user = User::where('email', $setting->value)->first();
            $values["check_by_id"] = $user->employee->id;
            // EXECUTIVE OFFICER
        }

        if($values["approved_by_id"] == null){
            $setting = Setting::where('key', 'executive.ao.complex.manager')->first();
            $user = User::where('email', $setting->value)->first();
            $values["approved_by_id"] = $user->employee->id;
            // EXECUTIVE OFFICER
        }

        $values['status'] = 1;


        $renovations = Renovation::create($values);
        return redirect()->route('renovations.index', ['status' => 1])->with('success', 'Renovation Permit created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Renovation $renovation)
    {
        return view('permits.renovations.show', compact('renovation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Renovation $renovation)
    {
        return view('permits.renovations.edit', [
            'renovation' => $renovation,
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'users' => $this->getSelectOptions(User::class, "email",User::where('user_type', User::USER)->get()),
            'administrative_officers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::ADMINISTRATIVE_OFFICER)->get()
            ),
            'executive_ao_complex_managers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::EXECUTIVE_AO_COMPLEX_MANAGER)->get()
            ),
            'property_engineers' => $this->getSelectOptions(
                Employee::class, 
                "full_name", 
                Employee::where('position_id', Position::PROPERTY_ENGINEER)->get()
            ),
            'vendors' => $this->getSelectOptions(
                Vendor::class, 
                "company_name", 
                Vendor::where('is_contractor', true)->get()
            ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Renovation $renovation)
    {
        $request->validate([
            'unit_id' => 'required',
            'user_id' => 'required',
        ]);

        $values = $request->all();


        if(array_key_exists("requirement_checklists" , $values))
            $values["requirement_checklists"] = implode(",", $values["requirement_checklists"]);
        else
            $values["requirement_checklists"] = null;

        if(array_key_exists("refundable_checklists" , $values))
            $values["refundable_checklists"] = implode(",", $values["refundable_checklists"]);
        else
            $values["refundable_checklists"] = null;

        if(array_key_exists("workers_identification_checklists" , $values))
            $values["workers_identification_checklists"] = implode(",", $values["workers_identification_checklists"]);
        else
            $values["workers_identification_checklists"] = null;

        if(array_key_exists("prior_checklists" , $values))
            $values["prior_checklists"] = implode(",", $values["prior_checklists"]);
        else
            $values["prior_checklists"] = null;

        if(array_key_exists("construction_bond_checklists" , $values))
            $values["construction_bond_checklists"] = implode(",", $values["construction_bond_checklists"]);
        else
            $values["construction_bond_checklists"] = null;
        
        $renovation->update($values);
        return redirect()->route('renovations.index', ['status' => $renovation->status])->with('success', 'Renovation Permit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Renovation $renovation)
    {
        $renovation->delete();
        return response()->json(["success" => "Record Deleted Successfully"],201);
    }
}
