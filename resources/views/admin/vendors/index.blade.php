@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Inventory', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('vendors.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Vendors" description="You have {{ count($vendors) }} vendors"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('vendors.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Company Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Company Address</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Contact #</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Contractor</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Supplier</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($vendors as $vendor)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $vendor->company_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $vendor->company_address }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $vendor->contact_no }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $vendor->email }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $vendor->is_contractor ? 'Yes' : 'No' }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $vendor->is_supplier ? 'Yes' : 'No' }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('vendors.show', $vendor), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('vendors.edit', $vendor), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('vendors.destroy', ['vendor' => $vendor]) . '`' .')', 
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