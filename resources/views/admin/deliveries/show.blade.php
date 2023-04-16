@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Deliveries', 'url' => route('deliveries.index')),
        array('name' => 'View', 'url' => route('deliveries.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Delivery" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Delivery Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Unit No." value="{{ $delivery->unit->unit_number }}"/>
                            <x-show-item label="Type" value="{{ $delivery->type_name }}"/>
                            <x-show-item label="Receiver Name" value="{{ $delivery->receiver_name }}"/>
                            <x-show-item label="From" value="{{ $delivery->from }}"/>
                            <x-show-item label="Number of items" value="{{ $delivery->number_of_items }}"/>
                            <x-show-item label="Reference number" value="{{ $delivery->reference_number }}"/>
                            <x-show-item label="Notes" value="{{ $delivery->notes }}"/>
                            <x-show-item label="Expected Arrival Date & Time" value="{{ $delivery->expected_arrival_date }}"/>
                            <x-show-item label="Plate Number" value="{{ $delivery->plate_number }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
