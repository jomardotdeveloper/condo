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
            <form action="{{ route('move-outs.store') }}" method="POST" class="row">
                @csrf
                <h6 class="title overline-title text-base">MOVE-OUT CLEARANCE FORM</h6>

                

                <div class="col-4">
                    <x-input name="first_name" label="First Name" type="text" default-value="{{request()->old('first_name')}}"/>
                </div>
                
                <div class="col-4">
                    <x-input name="middle_name" label="Middle Name" type="text" />
                </div>
                
                <div class="col-4">
                    <x-input name="last_name" label="Last Name" type="text" />
                </div>
                
                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" />
                </div>

                <div class="col-6 mt-2">
                    <x-select name="resident_type" label="Unit owner or Tenant" :options="$resident_types" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="move_out_date" label="Date of Move-Out" type="date" />
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
                            @for ($i = 10; $i > 0; $i--)
                                <tr>
                                    <td>
                                        <x-input name="item_quantities[]" label="Name" type="text" />
                                    </td>
                                    <td>
                                        <x-input name="item_names[]" label="Relation" type="text" />
                                    </td>
                                    <td>
                                        <x-input name="item_descriptions[]" label="Age" type="number" />
                                    </td>
                                    <td>
                                        <x-input name="item_remarks[]" label="Remarks" type="text" />
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
                                <x-checkbox name="charges_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-4">
                    <x-input name="or_ar_number" label="OR / AR Number" type="text" />
                </div>

                <div class="col-4">
                    <x-input name="amount" label="Amount" type="number" />
                </div>

                <div class="col-4">
                    <x-input name="others" label="Others" type="text" />
                </div>

                
                

                <div class="col-12 mt-2">
                    <x-input name="additional_instruction_by_accounting" label="Additional Instruction by Accounting Department" type="text" />
                </div>

                
                <div class="col-3 mt-2">
                    <x-input name="requested_by" label="Requested by" type="text" />
                </div>

                {{-- <div class="col-3 mt-2">
                    <x-input name="approved_by" label="Approved by" type="text" />
                </div> --}}

                <div class="col-6 mt-2">
                    <x-input name="additional_instruction" label="Additional Instruction by the unit owner, if any:" type="text" />
                </div>

                {{-- <div class="col-4 mt-2">
                    <x-input name="cleared_by" label="Cleared by" type="text" />
                </div>

                <div class="col-4 mt-2">
                    <x-input name="verified_by" label="Verified by" type="text" />
                </div>

                <div class="col-4 mt-2">
                    <x-input name="noted_by" label="Noted by" type="text" />
                </div> --}}


                <div class="col-6 mt-2">
                    <x-select name="cleared_by_id" label="Cleared By" :options="$administrative_officers" />
                </div>
                
                <div class="col-6 mt-2">
                    <x-select name="verified_by_id" label="Verified By" :options="$finance_departments" />
                </div>
                
                
                <div class="col-6 mt-2">
                    <x-select name="approved_by_id" label="Approved By" :options="$executive_ao_complex_managers" />
                </div>
                
                <div class="col-6 mt-2">
                    <x-select name="noted_by_id" label="Approved By" :options="$security_officers" />
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

