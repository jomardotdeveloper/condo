@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Clusters', 'url' => route('clusters.index')),
        array('name' => 'Edit', 'url' => route('clusters.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Cluster" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('clusters.update', ['cluster' => $cluster]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6 mt-2">
                    <x-input name="name" label="Name" type="text" :is-required="true" :default-value="$cluster->name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_towers" label="Unit Towers (Comma Separated)" type="text" :default-value="$cluster->unit_towers"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="reading_day" label="Bills reading day" type="number" :is-required="true" :default-value="$cluster->reading_day"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="due_date" label="Utilities due date" type="number" :is-required="true" :default-value="$cluster->due_date"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="monthly_due_rate" label="Monthly Due Rate" type="number" :is-required="true" :default-value="$cluster->monthly_due_rate"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_rate" label="Parking Rate " type="number" :is-required="true" :default-value="$cluster->parking_rate"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="electricity_rate" label="Electricity Rate" type="number" :is-required="true" :default-value="$cluster->electricity_rate"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="water_rate" label="Water Rate" type="number" :is-required="true" :default-value="$cluster->water_rate"/>
                </div>


                <div class="col-6 mt-2">
                    <x-input name="penalty_rate" label="Penalty Rate" type="number" :is-required="true" :default-value="$cluster->penalty_rate"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="recollection_fee" label="Recollection Fee" type="number" :is-required="true" :default-value="$cluster->recollection_fee"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Save Changes" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection