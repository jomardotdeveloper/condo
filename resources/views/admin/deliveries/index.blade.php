@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Deliveries', 'url' => route('deliveries.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Deliveries" description="You have {{ count($deliveries) }} deliveries"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('deliveries.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Date Created</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Floor</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">From</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Receiver</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Reference number</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Expected date & time of arrival</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($deliveries as $delivery)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $delivery->created_at }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->unit->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->unit->unit_floor }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->type_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->from }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->receiver_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->reference_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $delivery->expected_arrival_date }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('deliveries.show', $delivery), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('deliveries.edit', $delivery), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('deliveries.destroy', ['delivery' => $delivery]) . '`' .')', 
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