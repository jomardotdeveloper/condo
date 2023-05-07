@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Parkings', 'url' => route('user-parkings.index')),
        array('name' => 'View', 'url' => route('parkings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Parking" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Parking Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Unit Owner" value="{{ $parking->user->application->full_name }}"/>
                            <x-show-item label="Cluster" value="{{ $parking->cluster->name }}"/>
                            <x-show-item label="Unit Tower" value="{{ $parking->unit_tower }}"/>
                            <x-show-item label="Parking Floor Area" value="{{ $parking->parking_floor_area }}"/>
                            <x-show-item label="Parking Level" value="{{ $parking->parking_level }}"/>
                            <x-show-item label="Slot Number" value="{{ $parking->slot_number }}"/>
                            <x-show-item label="Plate Number" value="{{ $parking->plate_number }}"/>
                            <x-show-item label="Status" value="{{ $parking->status_name }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-comment model="parking" :record=" $parking->id " :comments="$comments" />
</div>

@endsection
