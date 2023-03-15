@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Inventory', 'url' => 'javascript:void(0);'),
        array('name' => 'Supplier Items', 'url' => route('supplier-items.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Supplier Items" description="You have {{ count($supplier_items) }} supplier items"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('supplier-items.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Supplier</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Items</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($supplier_items as $item)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $item->vendor->company_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $item->lines }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('supplier-items.edit', $item), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('supplier-items.destroy', ['supplier_item' => $item]) . '`' .')', 
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