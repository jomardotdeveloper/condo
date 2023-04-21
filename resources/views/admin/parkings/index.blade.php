@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Parkings', 'url' => route('parkings.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Parkings" description="You have {{ count($parkings) }} parkings"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('parkings.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit Owner</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Tower</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($parkings as $parking)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $parking->user->application->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $parking->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $parking->unit_tower }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $parking->status_name }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('parkings.show', $parking), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('parkings.edit', $parking), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('parkings.destroy', ['parking' => $parking]) . '`' .')', 
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