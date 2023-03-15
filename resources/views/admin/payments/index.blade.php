@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Payments', 'url' => route('payments.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Payments" description="You have {{ count($payments) }} payments"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('payments.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Create</a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Invoice</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Total Amount</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payment Method</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Payment Reference</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($payments as $payment)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $payment->formatted_id }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $payment->invoice->formatted_id }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $payment->amount  }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $payment->payment_method }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $payment->payment_reference }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.payment_status')[$payment->payment_status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('payments.show', $payment), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('payments.edit', $payment), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('payments.destroy', ['payment' => $payment]) . '`' .')', 
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