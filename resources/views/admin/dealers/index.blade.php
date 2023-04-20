@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('dealers.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="{{ $status_name }}" description="You have {{ count($dealers) }} vendors"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('dealers.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Company Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Contact Person</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Services</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($dealers as $dealer)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $dealer->organization_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $dealer->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ implode(' , ' ,$dealer->category_checklists_names) }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $dealer->status_name }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('dealers.show', $dealer), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('dealers.edit', $dealer), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('dealers.destroy', ['dealer' => $dealer]) . '`' .')', 
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