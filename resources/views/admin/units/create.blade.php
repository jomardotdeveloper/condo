@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Units', 'url' => route('units.index')),
        array('name' => 'Create', 'url' => route('units.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Unit" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('units.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6 mt-2">
                    <x-input name="unit_number" label="Unit No." type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="cluster_id" label="Cluster" onchange="onchangeCluster()" :options="$clusters" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_towers" label="Unit Towers"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_floor" label="Unit Floor" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_room" label="Unit Room" type="text" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="unit_type" label="Unit Type" :options="$unit_types" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="floor_area" label="Floor Area" type="text" />
                </div>

                {{-- <div class="col-6 mt-2">
                    <x-input name="unit_association_fee" label="Unit Association Fee" type="number" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="unit_parking_fee" label="Unit Parking Fee" type="number" />
                </div> --}}

                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$unit_status" :is-required="true"/>
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