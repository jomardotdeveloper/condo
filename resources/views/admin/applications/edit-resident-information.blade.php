<h6 class="title overline-title text-base">RESIDENT'S INFORMATION SHEET</h6>


<div class="col-4">
    <x-input name="date" label="Date" type="date" :default-value="$application->residentInformation->date"/>
</div>

<div class="col-4">
    <x-input name="mobile_number" label="Mobile Number" type="text" :default-value="$application->residentInformation->mobile_number"/>
</div>

<div class="col-4">
    <x-input name="email" label="Email" type="email" :default-value="$application->residentInformation->email"/>
</div>

<div class="col-6">
    <x-input name="address" label="Address" type="text" :default-value="$application->residentInformation->address"/>
</div>

<div class="col-3">
    <x-input name="occupation" label="Occupation" type="text" :default-value="$application->residentInformation->occupation"/>
</div>

<div class="col-3">
    <x-input name="citizenship" label="Citizenship" type="text" :default-value="$application->residentInformation->citizenship"/>
</div>

<div class="col-4 mt-2">
    <x-select name="marital_status" label="Marital Status" :options="$marital_status" :default-value="$application->residentInformation->marital_status"/>
</div>

<div class="col-4 mt-2">
    <x-select name="gender" label="Gender" :options="$gender" :default-value="$application->residentInformation->gender"/>
</div>

<div class="col-4 mt-2">
    <x-input name="telephone_number" label="Telephone Number" type="text" :default-value="$application->residentInformation->telephone_number"/>
</div>

<h6 class="title overline-title text-base mt-3">Person to contact in case of emergency</h6>
<div class="col-4 mt-1">
    <x-input name="emergency_name" label="Name" type="text" :default-value="$application->residentInformation->emergency_name"/>
</div>

<div class="col-4 mt-1">
    <x-input name="emergency_contact" label="Contact Number" type="text" :default-value="$application->residentInformation->emergency_contact"/>
</div>

<div class="col-4 mt-1">
    <x-input name="emergency_address" label="Address" type="text" :default-value="$application->residentInformation->emergency_address"/>
</div>


<div class="col-12 mt-2">
    <h6>Authorized Unit Occupants</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">RELATION</th>
                <th scope="col">AGE</th>
                <th scope="col">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 7; $i++)
                <tr>
                    <td>
                        <x-input name="authorized_unit_occupant_names[]" label="Name" type="text" :default-value="$application->residentInformation->auc_names_arr[$i]"/>
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_relations[]" label="Relation" type="text" :default-value="$application->residentInformation->auc_relations_arr[$i]"/>
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_ages[]" label="Age" type="number" :default-value="$application->residentInformation->auc_ages_arr[$i]"/>
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_remarks[]" label="Remarks" type="text" :default-value="$application->residentInformation->auc_remarks_arr[$i]"/>
                    </td>
                </tr>
            @endfor
            
        </tbody>
    </table>
</div>

<div class="col-12 mt-2">
    <h6>Househelper and Drivers</h6>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">NAME</th>
                <th scope="col">AGE</th>
                <th scope="col">REMARKS</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 3; $i++)
                <tr>
                    <td>
                        <x-input name="househelper_driver_names[]" label="Name" type="text" :default-value="$application->residentInformation->hd_names_arr[$i]"/>
                    </td>
                    <td>
                        <x-input name="househelper_driver_ages[]" label="Age" type="number" :default-value="$application->residentInformation->hd_ages_arr[$i]"/>
                    </td>
                    <td>
                        <x-input name="househelper_driver_remarks[]" label="Remarks" type="text" :default-value="$application->residentInformation->hd_remarks_arr[$i]"/>
                    </td>
                </tr>
            @endfor
            
        </tbody>
    </table>
</div>



<div class="col-6 mt-2">
    <x-input name="requested_by" label="Requested By" type="text" :default-value="$application->residentInformation->requested_by"/>
</div>

<div class="col-6 mt-2">
    <x-input name="noted_by" label="Noted By" type="text" :default-value="$application->residentInformation->noted_by"/>
</div>

