@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Units', 'url' => route('units.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Units" description="You have {{ count($units) }} units"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('units.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit No.</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Tower</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Floor</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Room</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Floor Area</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($units as $unit)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $unit->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $unit->unit_tower }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $unit->unit_floor }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $unit->unit_room }}
                        </td>
                        <td class="nk-tb-col">
                            {{  config('enums.unit_types')[$unit->unit_type]  }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $unit->floor_area }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.unit_status')[$unit->status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('units.show', $unit), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('units.edit', $unit), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('units.destroy', ['unit' => $unit]) . '`' .')', 
                                  'icon'=> 'icon ni ni-trash'),
                        ]"/>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection