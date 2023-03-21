@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Employees', 'url' => route('employees.index')),
        array('name' => 'Edit', 'url' => route('employees.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Employee" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('employees.update', ['employee' => $employee]) }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-4">
                    <x-input name="first_name" label="First Name" type="text" :default-value="$employee->first_name" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="middle_name" label="Middle Name" type="text" :default-value="$employee->middle_name"/>
                </div>

                <div class="col-4">
                    <x-input name="last_name" label="Last Name" type="text" :is-required="true" :default-value="$employee->last_name"/>
                </div>

                <div class="col-4">
                    <x-input name="email" label="Email" type="email" :is-required="true" :default-value="$employee->user->email"/>
                </div>

                <div class="col-4">
                    <x-input name="password" label="Update Password" type="password" />
                </div>

                <div class="col-6 mt-2">
                    <x-select name="position_id" label="Position" :options="$positions" :is-required="true" :default-value="$employee->position->id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="department_id" label="Department" :options="$departments" :is-required="true" :default-value="$employee->department->id"/>
                </div>

                <div class="col-4 mt-2">
                    <x-input name="signature_src" label="Update Signature" type="file" />
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection