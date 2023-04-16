@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Guests', 'url' => route('guests.index')),
        array('name' => 'View', 'url' => route('guests.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Guest" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Guest Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Full Name" value="{{ $guest->visitor->full_name }}"/>
                            <x-show-item label="Contact Number" value="{{ $guest->visitor->contact_number }}"/>
                            <x-show-item label="Email" value="{{ $guest->visitor->email }}"/>
                            <x-show-item label="Address" value="{{ $guest->visitor->address }}"/>
                            <x-show-item label="Unit" value="{{ $guest->unit->unit_number }}"/>
                            <x-show-item label="Valid ID" value="{{ $guest->valid_id_name }}"/>
                            <x-show-item label="Valid ID Number" value="{{ $guest->valid_id_number }}"/>
                            <x-show-item label="Reason" value="{{ $guest->reason }}"/>
                            <x-show-item label="Number of guests" value="{{ $guest->number_of_guests }}"/>
                            <x-show-item label="Plate Number" value="{{ $guest->plate_number }}"/>
                            <x-show-item label="Expected Arrival Date" value="{{ $guest->expected_arrival_date }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
