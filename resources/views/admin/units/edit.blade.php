@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Units', 'url' => route('units.index')),
        array('name' => 'Edit', 'url' => route('units.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Unit" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('units.update', ['unit' => $unit]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6 mt-2">
                    <x-input name="unit_number" label="Unit No." type="text" :is-required="true" default-value="{{ $unit->unit_number }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="cluster_id" label="Cluster" onchange="onchangeCluster()" :options="$clusters" :is-required="true" default-value="{{ $unit->cluster_id }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_towers" label="Unit Towers" default-value="{{ $unit->unit_tower }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_floor" label="Unit Floor" type="text" :is-required="true" default-value="{{ $unit->unit_floor }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_room" label="Unit Room" type="text" :is-required="true" default-value="{{ $unit->unit_room }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_type" label="Unit Type" :options="$unit_types" :is-required="true" default-value="{{ $unit->unit_type }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="floor_area" label="Floor Area" type="text" default-value="{{ $unit->floor_area }}"/>
                </div>

                {{-- <div class="col-6 mt-2">
                    <x-input name="unit_association_fee" label="Unit Association Fee" type="number" default-value="{{ $unit->unit_association_fee }}"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_parking_fee" label="Unit Parking Fee" type="number" default-value="{{ $unit->unit_parking_fee }}"/>
                </div> --}}

                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$unit_status" :is-required="true" default-value="{{ $unit->status }}"/>
                </div>


                <div class="col-12 mt-2">
                    <input type="submit" value="Save Changes" class="btn btn-primary" />
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
    var data = axios.get("{{url('/')}}/admin/clusters/unit-towers/" + cluster_id);
    return data;
}
</script>
@endpush