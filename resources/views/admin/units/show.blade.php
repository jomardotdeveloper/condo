@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Units', 'url' => route('units.index')),
        array('name' => 'View', 'url' => route('units.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Unit" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Unit Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Unit No." value="{{ $unit->unit_number }}"/>
                            <x-show-item label="Cluster" value="{{ $unit->cluster->name }}"/>
                            <x-show-item label="Unit Tower" value="{{ $unit->unit_tower }}"/>
                            <x-show-item label="Unit Floor" value="{{ $unit->unit_floor }}"/>
                            <x-show-item label="Unit Room" value="{{ $unit->unit_room }}"/>
                            <x-show-item label="Unit Type" value="{{ config('enums.unit_types')[$unit->unit_type] }}"/>
                            <x-show-item label="Floor Area" value="{{ $unit->cluster->name }}"/>
                            <x-show-item label="Unit Association Fee" value="{{ $unit->cluster->name }}"/>
                            <x-show-item label="Unit Parking Fee" value="{{ $unit->cluster->name }}"/>
                            <x-show-item label="Status" value="{{ config('enums.unit_status')[$unit->status] }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
