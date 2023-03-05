@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => 'Applications', 'url' => route('applications.index')),
        array('name' => 'Create', 'url' => route('applications.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Application" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('applications.store') }}" class="row" method="POST">
                @csrf
                <h6 class="title overline-title text-base">MOVE-IN CLEARANCE FORM</h6>

                <div class="col-4">
                    <x-input name="first_name" label="First Name" type="text" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="middle_name" label="Middle Name" type="text" />
                </div>

                <div class="col-4">
                    <x-input name="last_name" label="Last Name" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit" label="Unit" :options="$units" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="resident_type" label="Unit owner or Tenant" :options="$resident_types" :is-required="true"/>
                </div>
                <div class="col-6 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Tenant</label>
                        </div>
                        @foreach (config('checklists.move_in_tenant_checklists') as $key => $val )
                            <div class="col-12">
                                <x-checkbox name="unit_tenant_checklists[]" label="{{ $val }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-6 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Unit Owner</label>
                        </div>
                        @foreach (config('checklists.move_in_owner_checklists') as $key => $val )
                            <div class="col-12">
                                <x-checkbox name="unit_owner_checklists[]" label="{{ $val }}" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="tenant_bond_ar" label="Tenant Bond AR" type="text" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="utility_bond_ar" label="Utility Bond AR" type="text" />
                </div>
                




                <h6 class="title overline-title text-base">RESIDENT'S INFORMATION SHEET</h6>


                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection