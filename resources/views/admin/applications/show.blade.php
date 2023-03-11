@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => 'Applications', 'url' => route('applications.index')),
        array('name' => 'View', 'url' => route('applications.create')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="View Application" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <form method="POST" action="{{ route('applications.move-status', ['application' => $application]) }}">
        @csrf
        <input type="hidden" name="status" value="2">
        <button type="submit" class="btn btn-primary d-none d-md-inline-flex mb-2">Move to For Payment </button>
    </form>
    {{-- <a href="{{ route('applications.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Move to For Payment </a>
    <a href="{{ route('applications.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Payment</a> --}}


    <div class="card">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">MOVE-IN CLEARANCE FORM</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Date of Move-In" value="{{ $application->moveIn->move_in_date }}"/>
                            <x-show-item label="Resident's Name" value="{{ $application->full_name }}"/>
                            <x-show-item label="Unit" value="{{ $application->unit->unit_number }}"/>
                            <x-show-item label="No. of Person(s) to move-in" value="{{ $application->moveIn->number_of_person }}"/>
                            <x-show-item label="No. of Person(s) to move-in" value="{{ $application->moveIn->number_of_person }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
