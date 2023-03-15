@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Water Readings', 'url' => route('waters.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Water Readings" description="You have {{ count($waters) }} water readings"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('waters.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">From</span></th>
                        <th class="nk-tb-col"><span class="sub-text">To</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Reading</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($waters as $water)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $water->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $water->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $water->date_from }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $water->date_to }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $water->reading }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('waters.edit', $water), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('waters.destroy', ['water' => $water]) . '`' .')', 
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