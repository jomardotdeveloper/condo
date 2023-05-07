@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Deliveries', 'url' => route('deliveries.index')),
        array('name' => 'Edit', 'url' => route('deliveries.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Delivery" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('deliveries.update', ['delivery' => $delivery]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true" :default-value="$delivery->unit_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="type" label="Type" :options="$types" :is-required="true" :default-value="$delivery->type"/>
                </div>

                <div class="col-6">
                    <x-input name="receiver_name" label="Receiver Name" type="text" :default-value="$delivery->receiver_name"/>
                </div>

                <div class="col-6">
                    <x-input name="from" label="From" type="text" :default-value="$delivery->from"/>
                </div>

                <div class="col-6">
                    <x-input name="number_of_items" label="Number of items" type="text" :default-value="$delivery->number_of_items"/>
                </div>

                <div class="col-6">
                    <x-input name="reference_number" label="Reference Number" type="text" :default-value="$delivery->reference_number"/>
                </div>

                <div class="col-6">
                    <x-input name="notes" label="Notes" type="text" :default-value="$delivery->notes"/>
                </div>

                @if (auth()->user()->user_type == 2)
                <div class="col-6">
                    <x-select name="is_approved" label="Approved" :options="[['id' => 1, 'name' => 'YES'], ['id' => 2, 'name' => 'NO']]"  :is-required="true"  :default-value="$delivery->is_approved ? 1 : 2"/>
                </div>
                @endif

                <div class="col-6">
                    <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" :default-value="$delivery->expected_arrival_date"/>
                </div>

                <div class="col-6">
                    <x-input name="plate_number" label="Plate Number" type="text" :default-value="$delivery->plate_number"/>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection