@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Deliveries', 'url' => route('deliveries.index')),
        array('name' => 'Create', 'url' => route('deliveries.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Delivery" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('deliveries.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="type" label="Type" :options="$types" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="receiver_name" label="Receiver Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="from" label="From" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="number_of_items" label="Number of items" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="reference_number" label="Reference Number" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="notes" label="Notes" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" />
                </div>

                <div class="col-6">
                    <x-input name="plate_number" label="Plate Number" type="text" />
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection