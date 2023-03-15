!@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move Out', 'url' => 'javascript:void(0);'),
        array('name' => $title, 'url' => route('departments.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Move Outs" description="You have {{ count($move_outs) }} move outs"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('move-outs.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Resident Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date of Move-In</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($move_outs as $move_out)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $move_out->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $move_out->move_out_date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $move_out->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.application_status')[$move_out->status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('move-outs.show', $move_out), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('move-outs.edit', $move_out), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('move-outs.destroy', ['move_out' => $move_out]) . '`' .')', 
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