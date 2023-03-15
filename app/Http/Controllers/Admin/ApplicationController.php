<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\InvoiceTrait;
use App\Http\Traits\PaymentTrait;
use App\Models\Application;
use App\Models\Debit;
use App\Models\Invoice;
use App\Models\MoveIn;
use App\Models\ResidentInformation;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;

class ApplicationController extends Controller
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

        $applications = Application::where('status', $_GET['status'])->get()->all();
        return view('admin.applications.index', compact('applications', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.applications.create', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
            'gender' => $this->getEnumSelectOptions(config('enums.gender')),
            'marital_status' => $this->getEnumSelectOptions(config('enums.marital_status')),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'marital_status' => 'required',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'move_in_date' => 'required',
            'number_of_person' => 'required',
            'unit_id' => 'required',
            'resident_type' => 'required',
        ]);

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

        if(array_key_exists("authorized_unit_occupant_names" , $values))
            $values["authorized_unit_occupant_names"] = implode(",", $values["authorized_unit_occupant_names"]);

        if(array_key_exists("authorized_unit_occupant_relations" , $values))
            $values["authorized_unit_occupant_relations"] = implode(",", $values["authorized_unit_occupant_relations"]);

        if(array_key_exists("authorized_unit_occupant_ages" , $values))
            $values["authorized_unit_occupant_ages"] = implode(",", $values["authorized_unit_occupant_ages"]);

        if(array_key_exists("authorized_unit_occupant_remarks" , $values))
            $values["authorized_unit_occupant_remarks"] = implode(",", $values["authorized_unit_occupant_remarks"]);

        if(array_key_exists("househelper_driver_names" , $values))
            $values["househelper_driver_names"] = implode(",", $values["househelper_driver_names"]);

        if(array_key_exists("househelper_driver_ages" , $values))
            $values["househelper_driver_ages"] = implode(",", $values["househelper_driver_ages"]);

        if(array_key_exists("househelper_driver_remarks" , $values))
            $values["househelper_driver_remarks"] = implode(",", $values["househelper_driver_remarks"]);


        $move_in = MoveIn::create($values);
        $resident = ResidentInformation::create($values);

        $application = Application::create([
            'first_name' => $values['first_name'],
            'last_name' => $values['last_name'],
            'middle_name' => $values['middle_name'],
            'is_owner' => $values['resident_type'] == "1" ? true : false,
            'unit_id' => $values['unit_id'],
            'move_in_id' => $move_in->id,
            'status' => 1,
            'resident_information_id' => $resident->id,
        ]);

        if($request->from_frontend)
            return redirect()->route('application', ['success' => 1]);
        return redirect()->route('applications.index', ['status' => 1])->with('success', 'Application created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        return view('admin.applications.show', [
            'application' => $application,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        return view('admin.applications.edit', [
            'units' => $this->getSelectOptions(Unit::class, "unit_number"),
            'resident_types' => $this->getResidentTypeOptions(),
            'gender' => $this->getEnumSelectOptions(config('enums.gender')),
            'marital_status' => $this->getEnumSelectOptions(config('enums.marital_status')),
            'application' => $application,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([
            'marital_status' => 'required',
            'gender' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'move_in_date' => 'required',
            'number_of_person' => 'required',
            'unit_id' => 'required',
            'resident_type' => 'required',
        ]);

        $values = $request->all();
        
        if(array_key_exists("unit_owner_checklists" , $values))
            $values["unit_owner_checklists"] = implode(",", $values["unit_owner_checklists"]);
        else
            $values["unit_owner_checklists"] = null;

        if(array_key_exists("unit_tenant_checklists" , $values))
            $values["unit_tenant_checklists"] = implode(",", $values["unit_tenant_checklists"]);
        else
            $values["unit_tenant_checklists"] = null;

        if(array_key_exists("charges_checklists" , $values))
            $values["charges_checklists"] = implode(",", $values["charges_checklists"]);
        else
            $values["charges_checklists"] = null;

        if(array_key_exists("charges_remarks" , $values))
            $values["charges_remarks"] = implode(",", $values["charges_remarks"]);
        else
            $values["charges_remarks"] = null;

        if(array_key_exists("signature_checklists" , $values))
            $values["signature_checklists"] = implode(",", $values["signature_checklists"]);
        else
            $values["signature_checklists"] = null;

        if(array_key_exists("authorized_unit_occupant_names" , $values))
            $values["authorized_unit_occupant_names"] = implode(",", $values["authorized_unit_occupant_names"]);
        else
            $values["authorized_unit_occupant_names"] = null;

        if(array_key_exists("authorized_unit_occupant_relations" , $values))
            $values["authorized_unit_occupant_relations"] = implode(",", $values["authorized_unit_occupant_relations"]);
        else
            $values["authorized_unit_occupant_relations"] = null;

        if(array_key_exists("authorized_unit_occupant_ages" , $values))
            $values["authorized_unit_occupant_ages"] = implode(",", $values["authorized_unit_occupant_ages"]);
        else
            $values["authorized_unit_occupant_ages"] = null;

        if(array_key_exists("authorized_unit_occupant_remarks" , $values))
            $values["authorized_unit_occupant_remarks"] = implode(",", $values["authorized_unit_occupant_remarks"]);
        else
            $values["authorized_unit_occupant_remarks"] = null;

        if(array_key_exists("househelper_driver_names" , $values))
            $values["househelper_driver_names"] = implode(",", $values["househelper_driver_names"]);
        else
            $values["househelper_driver_names"] = null;

        if(array_key_exists("househelper_driver_ages" , $values))
            $values["househelper_driver_ages"] = implode(",", $values["househelper_driver_ages"]);
        else
            $values["househelper_driver_ages"] = null;

        if(array_key_exists("househelper_driver_remarks" , $values))
            $values["househelper_driver_remarks"] = implode(",", $values["househelper_driver_remarks"]);
        else
            $values["househelper_driver_remarks"] = null;

        $move_in = $application->moveIn->update($values);
        $resident = $application->residentInformation->update($values);
        $application->update($values);

        return redirect()->route('applications.index', ['status' => 1])->with('success', 'Application updated successfully.');
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

    public function moveToStatus(Request $request, Application $application) {
        $values = $request->all();

        $application->status = $values['status'];
        $application->save();

        return redirect()->route('applications.index', ['status' => $values['status']])->with('success', 'Application has been moved.');
    }


    public function storeInvoice(Request $request) {
        $this->createDebit($request, Debit::MOVE_IN);
        $application = Application::find($request->application_id);
        $application->status = Application::FOR_PAYMENT;
        $application->save();
        return redirect()->route('applications.index', ['status' => Application::FOR_PAYMENT])->with('success', 'Invoice created successfully. Application status has been changed to "For Payment".');
    }

    public function storePayment(Request $request) {
        $application = Application::find($request->application_id);
        $this->createSubscription($request);
        $application->status = Application::LOBBY_GUARD;
        $application->save();
        return redirect()->route('applications.index', ['status' => Application::LOBBY_GUARD])->with('success', 'Payment created successfully. Application status has been changed to "Lobby Guard".');
    }

    public function storeUser(Request $request) {
        $application = Application::find($request->application_id);
        $this->createUser($request, User::USER);
        $application->status = Application::DONE;
        $application->save();
        return redirect()->route('applications.index', ['status' => Application::LOBBY_GUARD])->with('success', 'User created successfully. Application status has been changed to "DONE".');
    }
}
