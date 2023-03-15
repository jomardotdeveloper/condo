@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'My Profile', 'url' => 'javascript:void(0);'),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="My Profile" description=""/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Account Information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Password</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem1">
                    <form class="row" method="POST" action="{{ route('admin.profile.change-personal-info') }}">
                        @csrf
                        <div class="col-4">
                            <x-input name="first_name" label="First Name" type="text" :is-required="true" default-value="{{ $employee->first_name }}"/>
                        </div>

                        <div class="col-4">
                            <x-input name="middle_name" label="Middle Name" type="text" default-value="{{ $employee->middle_name }}"/>
                        </div>

                        <div class="col-4">
                            <x-input name="last_name" label="Last Name" type="text" :is-required="true" default-value="{{ $employee->last_name }}"/>
                        </div>

                        <div class="col-4">
                            <x-input name="email" label="Email" type="email" :is-required="true" default-value="{{ $employee->user->email }}"/>
                        </div>

                        <div class="col-12 mt-2">
                            <input type="submit" value="Submit" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="tabItem2">
                    <form class="row" method="POST" action="{{ route('admin.profile.change-password') }}">
                        @csrf
                        <div class="col-4">
                            <x-input name="current_password" label="Current Password" type="password" :is-required="true"/>
                        </div>

                        <div class="col-4">
                            <x-input name="password" label="New Password" type="password" :is-required="true"/>
                        </div>

                        <div class="col-4">
                            <x-input name="password_confirmation" label="Confirm Password" type="password" :is-required="true"/>
                        </div>

                        <div class="col-12 mt-2">
                            <input type="submit" value="Submit" class="btn btn-primary" />
                        </div>
                        
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection