@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move Out', 'url' => 'javascript:void(0);'),
        array('name' => 'Move Outs', 'url' => route('move-outs.index')),
        array('name' => 'Create', 'url' => route('applications.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Move Out" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('move-outs.update', ['move_out' => $move_out]) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <h6 class="title overline-title text-base">MOVE-OUT CLEARANCE FORM</h6>

                

                <div class="col-4">
                    <x-input name="first_name" label="First Name" type="text" :default-value="$move_out->first_name"/>
                </div>
                
                <div class="col-4">
                    <x-input name="middle_name" label="Middle Name" type="text" :default-value="$move_out->middle_name"/>
                </div>
                
                <div class="col-4">
                    <x-input name="last_name" label="Last Name" type="text" :default-value="$move_out->last_name"/>
                </div>
                
                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :default-value="$move_out->unit_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="resident_type" label="Unit owner or Tenant" :options="$resident_types" :default-value="$move_out->is_owner ? 1 : 2"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="move_out_date" label="Date of Move-Out" type="date" :default-value="$move_out->move_out_date"/>
                </div>
                

                <div class="col-12 mt-2">
                    <h6>Items to be PULLED-OUT</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"> QUANTITIES</th>
                                <th scope="col"> NAMES</th>
                                <th scope="col">DESCRIPTIONS</th>
                                <th scope="col"> REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < 10; $i++)
                                <tr>
                                    <td>
                                        <x-input name="item_quantities[]" label="Name" type="text" :default-value="$move_out->item_quantities_arr[$i]" />
                                    </td>
                                    <td>
                                        <x-input name="item_names[]" label="Relation" type="text" :default-value="$move_out->item_names_arr[$i]"/>
                                    </td>
                                    <td>
                                        <x-input name="item_descriptions[]" label="Age" type="number" :default-value="$move_out->item_descriptions_arr[$i]"/>
                                    </td>
                                    <td>
                                        <x-input name="item_remarks[]" label="Remarks" type="text" :default-value="$move_out->item_remarks_arr[$i]"/>
                                    </td>
                                </tr>
                            @endfor
                            
                        </tbody>
                    </table>
                </div>

                <div class="col-12 mt-2" id="tenant_checklist">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">LISTS OF CHARGES BILLED</label>
                        </div>
                        @foreach (config('checklists.move_out_charges_checklists') as $key => $val )
                            <div class="col-4">
                                <x-checkbox name="charges_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $move_out->charges_checklists_arr)"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-4">
                    <x-input name="or_ar_number" label="OR / AR Number" type="text" :default-value="$move_out->or_ar_number"/>
                </div>

                <div class="col-4">
                    <x-input name="amount" label="Amount" type="number" :default-value="$move_out->amount"/>
                </div>

                <div class="col-4">
                    <x-input name="others" label="Others" type="text" :default-value="$move_out->others"/>
                </div>

                
                

                <div class="col-12 mt-2">
                    <x-input name="additional_instruction_by_accounting" label="Additional Instruction by Accounting Department" type="text" :default-value="$move_out->additional_instruction_by_accounting"/>
                </div>

                
                <div class="col-3 mt-2">
                    <x-input name="requested_by" label="Requested by" type="text" :default-value="$move_out->requested_by"/>
                </div>

                <div class="col-3 mt-2">
                    <x-input name="approved_by" label="Approved by" type="text" :default-value="$move_out->approved_by"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="additional_instruction" label="Additional Instruction by the unit owner, if any:" type="text" :default-value="$move_out->additional_instruction"/>
                </div>

                <div class="col-4 mt-2">
                    <x-input name="cleared_by" label="Cleared by" type="text" :default-value="$move_out->cleared_by"/>
                </div>

                <div class="col-4 mt-2">
                    <x-input name="verified_by" label="Verified by" type="text" :default-value="$move_out->verified_by"/>
                </div>

                <div class="col-4 mt-2">
                    <x-input name="noted_by" label="Noted by" type="text" :default-value="$move_out->noted_by"/>
                </div>
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

