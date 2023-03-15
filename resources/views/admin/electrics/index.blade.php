@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Electricity Readings', 'url' => route('electrics.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Electricity Readings" description="You have {{ count($electrics) }} electricity readings"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('electrics.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

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
                    @foreach ($electrics as $electric)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $electric->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $electric->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $electric->date_from }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $electric->date_to }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $electric->reading }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('electrics.edit', $electric), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('electrics.destroy', ['electric' => $electric]) . '`' .')', 
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