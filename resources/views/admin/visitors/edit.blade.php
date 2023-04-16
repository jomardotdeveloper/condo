@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Guests', 'url' => route('guests.index')),
        array('name' => 'Edit', 'url' => route('guests.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Guest" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('guests.update', ['guest' => $guest]) }} " class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6 mt-2">
                    <x-select name="visitor_id" label="Visitor" :options="$visitors" :is-required="true" :default-value="$guest->visitor_id"/>
                </div>



                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true" :default-value="$guest->unit_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="valid_id" label="Valid ID" :options="$valid_ids" :is-required="true" :default-value="$guest->valid_id"/>
                </div>

                <div class="col-6">
                    <x-input name="valid_id_number" label="Valid ID Number" type="text" :default-value="$guest->valid_id_number"/>
                </div>

                <div class="col-6">
                    <x-input name="reason" label="Reason of visitation" type="text" :default-value="$guest->reason"/>
                </div>

                <div class="col-6">
                    <x-input name="number_of_guests" label="Number of Guests" type="text" :default-value="$guest->number_of_guests"/>
                </div>

                <div class="col-6">
                    <x-input name="expected_arrival_date" label="Expected Arrival Date" type="datetime-local" :default-value="$guest->expected_arrival_date"/>
                </div>

                <div class="col-6">
                    <x-input name="plate_number" label="Plate Number" type="text" :default-value="$guest->plate_number"/>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection