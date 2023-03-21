<h6 class="title overline-title text-base">MOVE-IN CLEARANCE FORM</h6>

<div class="col-4">
    <x-input name="first_name" label="First Name" type="text" :default-value="$application->first_name"/>
</div>

<div class="col-4">
    <x-input name="middle_name" label="Middle Name" type="text" :default-value="$application->middle_name"/>
</div>

<div class="col-4">
    <x-input name="last_name" label="Last Name" type="text" :default-value="$application->last_name"/>
</div>

<div class="col-6 mt-2">
    <x-input name="move_in_date" label="Date of Move-In" type="date" :default-value="$application->moveIn->move_in_date"/>
</div>

<div class="col-6 mt-2">
    <x-input name="number_of_person" label="No. of Person(s) to move-in" type="number" :default-value="$application->moveIn->number_of_person"/>
</div>

<div class="col-6 mt-2">
    <x-select name="unit_id" label="Unit" :options="$units" :default-value="$application->unit_id"/>
</div>

<div class="col-6 mt-2">
    <x-select name="resident_type" label="Unit owner or Tenant" :options="$resident_types" :default-value="$application->is_owner ? '1' : '2'"/>
</div>

<div class="col-6 mt-2" id="tenant_checklist">
    <div class="row">
        <div class="col-12">
            <label class="form-label">Tenant</label>
        </div>
        @foreach (config('checklists.move_in_tenant_checklists') as $key => $val )
            <div class="col-12">
                <x-checkbox name="unit_tenant_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $application->moveIn->unit_tenant_checklists_arr)"/>
            </div>
        @endforeach
    </div>
</div>

<div class="col-6 mt-2" id="unit_owner_checklist">
    <div class="row">
        <div class="col-12" >
            <label class="form-label">Unit Owner</label>
        </div>
        @foreach (config('checklists.move_in_owner_checklists') as $key => $val )
            <div class="col-12">
                <x-checkbox name="unit_owner_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $application->moveIn->unit_owner_checklists_arr)"/>
            </div>
        @endforeach
    </div>
</div>

<div class="col-6 mt-2" id="tenand_bond_ar_container">
    <x-input name="tenant_bond_ar" label="Tenant Bond AR" type="text" :default-value="$application->moveIn->tenant_bond_ar" />
</div>

<div class="col-6 mt-2" id="utility_bond_ar_container">
    <x-input name="utility_bond_ar" label="Utility Bond AR" type="text" :default-value="$application->moveIn->utility_bond_ar" />
</div>

<div class="col-12 mt-2">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">LIST OF CHARGES BILLED</th>
                <th scope="col">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 0)
            @foreach (config('checklists.charges_checklists') as $key => $value)
            <tr>
                <td>
                    <x-checkbox name="charges_checklists[]" value="{{ $key }}" label="{{ $value }}" :is-checked="in_array(strval($key), $application->moveIn->charges_checklists_arr)"/>
                </td>
                <td>
                    <x-input name="charges_remarks[]" label="Remarks" type="text" :default-value="$application->moveIn->charges_remarks_arr[$i]"/>
                </td>
            </tr>
            @php($i++)
            @endforeach
        </tbody>
    </table>
</div>


<div class="col-12 mt-2" id="unit_owner_checklist">
    <div class="row">
        <div class="col-12" >
            <label class="form-label">Note that our tenant/s whose signature appears below are allowed to sign the following forms on our behalf:</label>
        </div>
        @foreach (config('checklists.signature_checklists') as $key => $val )
            <div class="col-6">
                <x-checkbox name="signature_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $application->moveIn->signature_checklists_arr)"/>
            </div>
        @endforeach
    </div>
</div>

<div class="col-3 mt-2">
    <x-input name="requested_by" label="Requested by" type="text" :default-value="$application->moveIn->requested_by"/>
</div>

{{-- <div class="col-3 mt-2">
    <x-input name="approved_by" label="Approved by" type="text" :default-value="$application->moveIn->approved_by"/>
</div> --}}

<div class="col-6 mt-2">
    <x-input name="additional_instruction" label="Additional Instruction by the unit owner, if any:" type="text" :default-value="$application->moveIn->additional_instruction"/>
</div>

<div class="col-6 mt-2">
    <x-select name="cleared_by_id" label="Cleared By" :options="$administrative_officers" :default-value="$application->moveIn->cleared_by_id"/>
</div>

<div class="col-6 mt-2">
    <x-select name="verified_by_id" label="Verified By" :options="$finance_departments" :default-value="$application->moveIn->verified_by_id"/>
</div>


<div class="col-6 mt-2">
    <x-select name="approved_by_id" label="Approved By" :options="$executive_ao_complex_managers" :default-value="$application->moveIn->approved_by_id"/>
</div>

<div class="col-6 mt-2">
    <x-select name="noted_by_id" label="Approved By" :options="$security_officers" :default-value="$application->moveIn->noted_by_id"/>
</div>
{{-- 
<div class="col-4 mt-2">
    <x-input name="cleared_by" label="Cleared by" type="text" :default-value="$application->moveIn->cleared_by"/>
</div>

<div class="col-4 mt-2">
    <x-input name="verified_by" label="Verified by" type="text" :default-value="$application->moveIn->verified_by" />
</div>

<div class="col-4 mt-2">
    <x-input name="noted_by" label="Noted by" type="text" :default-value="$application->moveIn->noted_by"/>
</div>
 --}}
