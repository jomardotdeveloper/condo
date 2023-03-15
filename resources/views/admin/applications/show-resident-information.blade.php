<x-show-item label="Date" value="{{ $application->residentInformation->date }}"/>
<x-show-item label="Mobile Number" value="{{ $application->residentInformation->mobile_number }}"/>
<x-show-item label="Email Address" value="{{ $application->residentInformation->email }}"/>
<x-show-item label="Permanent / Alternative Address" value="{{ $application->residentInformation->address }}"/>
<x-show-item label="Occupation" :value="$application->residentInformation->occupation"/>
<x-show-item label="Citizenship" :value="$application->residentInformation->citizenship "/>
<x-show-item label="Marital Status" value="{{ config('enums.marital_status')[$application->residentInformation->marital_status] }}"/>
<x-show-item label="Telephone Number" value="{{ $application->residentInformation->telephone_number }}"/>
<x-show-item label="Gender" value="{{ config('enums.gender')[$application->residentInformation->gender] }}"/>

<x-show-item label="Requested By" value="{{ $application->residentInformation->requested_by }}"/>
<x-show-item label="Noted By" value="{{ $application->residentInformation->noted_by }}"/>


<div class="nk-divider divider md"></div>
<div class="nk-block-head nk-block-head-sm nk-block-between">
    <h5 class="title">Person to notify in case of emergency</h5>
</div>
<x-show-item label="Name" value="{{ $application->residentInformation->emergency_name }}"/>
<x-show-item label="Contact #" value="{{ $application->residentInformation->emergency_contact }}"/>
<x-show-item label="Address" value="{{ $application->residentInformation->emergency_address }}"/>

<div class="nk-divider divider md"></div>

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
                        {{$application->residentInformation->auc_names_arr[$i]}}
                    </td>
                    <td>
                      {{ $application->residentInformation->auc_relations_arr[$i]}}
                    </td>
                    <td>
                        {{$application->residentInformation->auc_ages_arr[$i]}}
                    </td>
                    <td>
                        {{$application->residentInformation->auc_remarks_arr[$i]}}
                    </td>
                </tr>
            @endfor
            
        </tbody>
    </table>
</div>

<div class="nk-divider divider md"></div>

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
                        {{$application->residentInformation->hd_names_arr[$i]}}
                    </td>
                    <td>
                       {{ $application->residentInformation->hd_ages_arr[$i]}}
                    </td>
                    <td>
                        {{$application->residentInformation->hd_remarks_arr[$i]}}
                    </td>
                </tr>
            @endfor
            
        </tbody>
    </table>
</div>

