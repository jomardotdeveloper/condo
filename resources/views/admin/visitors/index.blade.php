@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Visitors', 'url' => 'javascript:void(0);'),
        array('name' => 'Guests', 'url' => route('guests.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Guests" description="You have {{ count($guests) }} guests"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('guests.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">New Visitor</a>
    <a href="{{ route('guests.create') }}?is_returnee=1"  class="btn btn-primary d-none d-md-inline-flex mb-2">Returnee Visitor</a>
    
    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Visitor</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Address</span></th>
                        <th class="nk-tb-col"><span class="sub-text">ID Presented</span></th>
                        <th class="nk-tb-col"><span class="sub-text">ID Number Presented</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Expected date & time of arrival</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($guests as $guest)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $guest->visitor->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $guest->visitor->address }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $guest->valid_id_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $guest->valid_id_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $guest->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $guest->expected_arrival_date }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('guests.show', $guest), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('guests.edit', $guest), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('guests.destroy', ['guest' => $guest]) . '`' .')', 
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