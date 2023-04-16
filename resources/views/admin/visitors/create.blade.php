@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Guests', 'url' => route('guests.index')),
        array('name' => 'Create', 'url' => route('guests.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Guest" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('guests.store') }} " class="row" method="POST">
                @csrf

                @if (!isset($_GET['is_returnee']))

                <div class="col-6">
                    <x-input name="first_name" label="First Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="last_name" label="Last Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="middle_name" label="Middle Name" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="contact_number" label="Contact #" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="email" label="Email" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="address" label="Address" type="text" />
                </div>
                
                @else
                <input type="hidden" name="is_returnee" value="1">
                <div class="col-6 mt-2">
                    <x-select name="visitor_id" label="Visitor" :options="$visitors" :is-required="true"/>
                </div>
                @endif



                <div class="col-6 mt-2">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="valid_id" label="Valid ID" :options="$valid_ids" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="valid_id_number" label="Valid ID Number" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="reason" label="Reason of visitation" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="number_of_guests" label="Number of Guests" type="text" />
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