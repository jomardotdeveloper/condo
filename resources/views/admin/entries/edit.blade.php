@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Cash Flow', 'url' => route('entries.index')),
        array('name' => 'Edit', 'url' => route('entries.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Cash Flow" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('entries.update', ['entry' => $entry]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-select name="account_id" label="Account" :options="$accounts" :default-value="$entry->account_id" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-select name="bank_id" label="Bank" :options="$banks" :default-value="$entry->bank_id"/>
                </div>

                <div class="col-6">
                    <x-input name="amount" label="Amount" type="number" :is-required="true" :default-value="$entry->amount"/>
                </div>

                <div class="col-6">
                    <x-input name="reference" label="Reference" type="text" :default-value="$entry->reference"/>
                </div>

                <div class="col-6">
                    <x-input name="source_document" label="Source Document" type="text" :default-value="$entry->source_document"/>
                </div>

                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection