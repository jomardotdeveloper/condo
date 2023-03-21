@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Employees', 'url' => route('employees.index')),
        array('name' => 'Create', 'url' => route('employees.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Employee" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('employees.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-4">
                    <x-input name="first_name" label="First Name" type="text" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="middle_name" label="Middle Name" type="text" />
                </div>

                <div class="col-4">
                    <x-input name="last_name" label="Last Name" type="text" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="email" label="Email" type="email" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="password" label="Password" type="password" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="password_confirmation" label="Confirm Password" type="password" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="position_id" label="Position" :options="$positions" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="department_id" label="Department" :options="$departments" :is-required="true"/>
                </div>

                <div class="col-4 mt-2">
                    <x-input name="signature_src" label="Signature" type="file" />
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection