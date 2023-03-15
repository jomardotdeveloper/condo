@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Payments', 'url' => route('payments.index')),
        array('name' => 'Create', 'url' => route('payments.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Payment" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('payments.store') }}" class="row" method="POST">
                @csrf

                <div class="col-6">
                    <x-select name="payment_status" label="Status" :options="$payment_status" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-select name="invoice_id" label="Invoice" :options="$invoices" :is-required="true"/>
                </div>
                
                <div class="col-4">
                    <x-input name="amount" label="Amount" type="number" :is-required="true"/>
                </div>

                <div class="col-4">
                    <x-input name="payment_method" label="Payment Method" type="text" />
                </div>

                <div class="col-4">
                    <x-input name="payment_reference" label="Payment Reference" type="text"/>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

