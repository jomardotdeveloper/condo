<h6 class="title overline-title text-base">RESIDENT'S INFORMATION SHEET</h6>


<div class="col-4">
    <x-input name="date" label="Date" type="date" :default-value="date('Y-m-d')"/>
</div>

<div class="col-4">
    <x-input name="mobile_number" label="Mobile Number" type="text" />
</div>

<div class="col-4">
    <x-input name="email" label="Email" type="email" />
</div>

<div class="col-6">
    <x-input name="address" label="Address" type="text" />
</div>

<div class="col-3">
    <x-input name="occupation" label="Occupation" type="text" />
</div>

<div class="col-3">
    <x-input name="citizenship" label="Citizenship" type="text" />
</div>

<div class="col-4 mt-2">
    <x-select name="marital_status" label="Marital Status" :options="$marital_status" />
</div>

<div class="col-4 mt-2">
    <x-select name="gender" label="Gender" :options="$gender" />
</div>

<div class="col-4 mt-2">
    <x-input name="telephone_number" label="Telephone Number" type="text" />
</div>

<h6 class="title overline-title text-base mt-3">Person to contact in case of emergency</h6>
<div class="col-4 mt-1">
    <x-input name="emergency_name" label="Name" type="text" />
</div>

<div class="col-4 mt-1">
    <x-input name="emergency_contact" label="Contact Number" type="text" />
</div>

<div class="col-4 mt-1">
    <x-input name="emergency_address" label="Address" type="text" />
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
            @for ($i = 7; $i > 0; $i--)
                <tr>
                    <td>
                        <x-input name="authorized_unit_occupant_names[]" label="Name" type="text" />
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_relations[]" label="Relation" type="text" />
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_ages[]" label="Age" type="number" />
                    </td>
                    <td>
                        <x-input name="authorized_unit_occupant_remarks[]" label="Remarks" type="text" />
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
            @for ($i = 3; $i > 0; $i--)
                <tr>
                    <td>
                        <x-input name="househelper_driver_names[]" label="Name" type="text" />
                    </td>
                    <td>
                        <x-input name="househelper_driver_ages[]" label="Age" type="number" />
                    </td>
                    <td>
                        <x-input name="househelper_driver_remarks[]" label="Remarks" type="text" />
                    </td>
                </tr>
            @endfor
            
        </tbody>
    </table>
</div>



<div class="col-6 mt-2">
    <x-input name="requested_by" label="Requested By" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="noted_by" label="Noted By" type="text" />
</div>

