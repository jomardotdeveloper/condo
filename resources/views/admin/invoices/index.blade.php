@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('invoices.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Invoices" description="You have {{ count($invoices) }} invoices"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('invoices.create') }}?type=4"  class="btn btn-primary d-none d-md-inline-flex mb-2">Normal</a>
    <a href="{{ route('invoices.create') }}?type=2"  class="btn btn-primary d-none d-md-inline-flex mb-2">Move In</a>
    <a href="{{ route('invoices.create') }}?type=3"  class="btn btn-primary d-none d-md-inline-flex mb-2">Move Out</a>
    <a href="{{ route('invoices.create') }}?type=1"  class="btn btn-primary d-none d-md-inline-flex mb-2">Monthly dues</a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $department->name }}
                        </td>
                        <x-datatable-action :items="[
                            
                            array('name' => 'Edit', 'url' => route('invoices.edit', $invoice), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('invoices.destroy', ['invoice' => $invoice]) . '`' .')', 
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