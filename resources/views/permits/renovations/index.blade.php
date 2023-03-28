@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Permit', 'url' => 'javascript:void(0);'),
        array('name' => $title, 'url' => route('renovations.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Renovation Clearances" description="You have {{ count($renovations) }} records"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('renovations.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Create</a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit Owner/Tenant</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($renovations as $renovation)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $renovation->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $renovation->unit->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $renovation->user->email  }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.application_status')[$renovation->status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('renovations.show', $renovation), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('renovations.edit', $renovation), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('renovations.destroy', ['renovation' => $renovation]) . '`' .')', 
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