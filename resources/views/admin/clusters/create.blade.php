@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Clusters', 'url' => route('clusters.index')),
        array('name' => 'Create', 'url' => route('clusters.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Cluster" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('clusters.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6 mt-2">
                    <x-input name="name" label="Name" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_towers" label="Unit Towers (Comma Separated)" type="text" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="reading_day" label="Bills reading day" type="number" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="due_date" label="Utilities due date" type="number" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="monthly_due_rate" label="Monthly Due Rate" type="number" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_rate" label="Parking Rate " type="number" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="electricity_rate" label="Electricity Rate" type="number" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="water_rate" label="Water Rate" type="number" :is-required="true"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection