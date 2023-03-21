<x-show-item label="Date of Move-In" value="{{ $application->moveIn->move_in_date }}"/>
<x-show-item label="Resident's Name" value="{{ $application->full_name }}"/>
<x-show-item label="Unit" value="{{ $application->unit->unit_number }}"/>
<x-show-item label="No. of Person(s) to move-in" value="{{ $application->moveIn->number_of_person }}"/>
<x-show-item label="Unit Owner" :value="$application->is_owner ? 'YES' : 'NO'"/>
<x-show-item label="Tenant" :value="!$application->is_owner ? 'YES' : 'NO'"/>
<x-show-item label="Requested By" value="{{ $application->moveIn->requested_by }}"/>
<x-show-item label="Additional Instruction by the unit owner, if any:" value="{{ $application->moveIn->additional_instruction }}"/>
<div class="nk-divider divider md"></div>
<x-show-item label="Approved By" value="{{ $application->moveIn->approvedBy->full_name }} {{ !$application->moveIn->approved_is_signed ? '(Not Yet Signed)' : '(Signed)' }}"/>
<x-show-item label="Cleared By" value="{{ $application->moveIn->clearedBy->full_name }} {{ !$application->moveIn->cleared_is_signed ? '(Not Yet Signed)' : '(Signed)' }}"/>
<x-show-item label="Checked and Verified By" value="{{ $application->moveIn->verifiedBy->full_name }} {{ !$application->moveIn->verified_is_signed ? '(Not Yet Signed)' : '(Signed)' }}"/>
<x-show-item label="Noted By" value="{{ $application->moveIn->notedBy->full_name }} {{ !$application->moveIn->noted_is_signed ? '(Not Yet Signed)' : '(Signed)' }}"/> 
<div class="nk-divider divider md"></div>
@if($application->is_owner)
<div class="nk-block">
    <div class="row">
        <div class="col-6">
            <div class="nk-block-head nk-block-head-sm nk-block-between">
                <h5 class="title">Submitted Requirements</h5>
            </div>
            <ul class="g-1">
                @foreach (config('checklists.move_in_owner_checklists') as $key => $val )
                        @if(in_array(strval($key), $application->moveIn->unit_owner_checklists_arr))
                        <li class="btn-group">
                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <div class="nk-block-head nk-block-head-sm nk-block-between">
                <h5 class="title">Missing Requirements</h5>
            </div>
            <ul class="g-1">
                @foreach (config('checklists.move_in_owner_checklists') as $key => $val )
                        @if(!in_array(strval($key), $application->moveIn->unit_owner_checklists_arr))
                        <li class="btn-group">
                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
@else
<div class="nk-block">
    <div class="row">
        <div class="col-6">
            <div class="nk-block-head nk-block-head-sm nk-block-between">
                <h5 class="title">Submitted Requirements</h5>
            </div>
            <ul class="g-1">
                @foreach (config('checklists.move_in_tenant_checklists') as $key => $val )
                        @if(in_array(strval($key), $application->moveIn->unit_tenant_checklists_arr))
                        <li class="btn-group">
                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
        <div class="col-6">
            <div class="nk-block-head nk-block-head-sm nk-block-between">
                <h5 class="title">Missing Requirements</h5>
            </div>
            <ul class="g-1">
                @foreach (config('checklists.move_in_tenant_checklists') as $key => $val )
                        @if(!in_array(strval($key), $application->moveIn->unit_tenant_checklists_arr))
                        <li class="btn-group">
                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif
<div class="nk-divider divider md"></div>

<div class="nk-block">
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
                        {{ $value }} : {{ in_array(strval($key), $application->moveIn->charges_checklists_arr) ? "YES" : "NO" }}
                    </td>
                    <td>
                        {{$application->moveIn->charges_remarks_arr[$i]}}
                    </td>
                </tr>
                @php($i++)
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="nk-divider divider md"></div>

<div class="nk-block">
    <div class="row">
        <div class="col-12">
            <div class="nk-block-head nk-block-head-sm nk-block-between">
                <h6 class="title">Note that our tenant/s whose signature appears below are allowed to sign the following forms on our behalf:</h6>
            </div>
            <ul class="g-1">
                @foreach (config('checklists.signature_checklists') as $key => $val )
                        @if(in_array(strval($key), $application->moveIn->signature_checklists_arr))
                        <li class="btn-group">
                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                        </li>
                        @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>

