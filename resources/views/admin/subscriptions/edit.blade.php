@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Payments', 'url' => route('subscriptions.index')),
        array('name' => 'Edit', 'url' => route('subscriptions.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Payment" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('subscriptions.update', ['subscription' => $subscription]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-select name="payment_status" label="Status" :options="$payment_status" :is-required="true" :default-value="$subscription->payment_status"/>
                </div>

                <div class="col-6">
                    <x-select name="debit_id" label="Invoice" :options="$debits" :default-value="$subscription->debit_id"/>
                </div>
                
                <div class="col-4">
                    <x-input name="amount" label="Amount" type="number" :is-required="true" :default-value="$subscription->amount"/>
                </div>

                <div class="col-4">
                    <x-input name="payment_method" label="Payment Method" type="text"  :default-value="$subscription->payment_method"/>
                </div>

                <div class="col-4">
                    <x-input name="payment_reference" label="Payment Reference" type="text" :default-value="$subscription->payment_reference"/>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

