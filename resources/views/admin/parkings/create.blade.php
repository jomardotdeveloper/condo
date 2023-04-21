@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Parkings', 'url' => route('parkings.index')),
        array('name' => 'Create', 'url' => route('parkings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Parking" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('parkings.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6 mt-2">
                    <x-input name="slot_number" label="Slot No." type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_floor_area" label="Parking Floor Area" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_level" label="Parking Level" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="plate_number" label="Plate Number" type="text" />
                </div>


                <div class="col-6 mt-2">
                    <x-select name="cluster_id" label="Cluster" onchange="onchangeCluster()" :options="$clusters" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_tower" label="Unit Towers"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="user_id" label="User" :options="$users" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$status" :is-required="true"/>
                </div>


                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
async function onchangeCluster() {
    var cluster_id = $('#cluster_id').val();

    if(!cluster_id) {
        $('#unit_towers').html("<option></option>");
        return;
    } 

    var towers = await getTowers(cluster_id);

    var options = "<option></option>";

    towers.data.forEach(function(tower) {
        options += "<option value='" + tower + "'>" + tower + "</option>";
    });

    $('#unit_towers').html(options);
}

async function getTowers(cluster_id) {
    var data = axios.get("clusters/unit-towers/" + cluster_id);
    return data;
}
</script>
@endpush