@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Parkings', 'url' => route('parkings.index')),
        array('name' => 'Edit', 'url' => route('parkings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Parking" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('parkings.update', ['parking' => $parking]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6 mt-2">
                    <x-input name="slot_number" label="Slot No." type="text" :is-required="true" :default-value="$parking->slot_number"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_floor_area" label="Parking Floor Area" type="text" :is-required="true" :default-value="$parking->parking_floor_area"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="parking_level" label="Parking Level" type="text" :is-required="true" :default-value="$parking->parking_level"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="plate_number" label="Plate Number" type="text" :default-value="$parking->plate_number"/>
                </div>


                <div class="col-6 mt-2">
                    <x-select name="cluster_id" label="Cluster" onchange="onchangeCluster()" :options="$clusters" :is-required="true" :default-value="$parking->cluster_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_tower" label="Unit Towers" :default-value="$parking->unit_tower"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="user_id" label="User" :options="$users" :is-required="true" :default-value="$parking->user_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$status" :is-required="true" :default-value="$parking->status"/>
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
        $('#unit_tower').html("<option></option>");
        return;
    } 

    var towers = await getTowers(cluster_id);

    var options = "<option></option>";

    towers.data.forEach(function(tower) {
        options += "<option value='" + tower + "'>" + tower + "</option>";
    });

    $('#unit_tower').html(options);
}

async function getTowers(cluster_id) {
    var data = axios.get("{{url('/')}}/admin/clusters/unit-towers/" + cluster_id);
    return data;
}
</script>
@endpush