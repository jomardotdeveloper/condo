@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Cash Flow', 'url' => route('entries.index')),
        array('name' => 'Create', 'url' => route('entries.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Cash Flow" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('entries.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-select name="account_id" label="Account" :options="$accounts" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-select name="bank_id" label="Bank" :options="$banks" />
                </div>

                <div class="col-6">
                    <x-input name="amount" label="Amount" type="number" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="reference" label="Reference" type="text" />
                </div>

                <div class="col-6">
                    <x-input name="source_document" label="Source Document" type="text" />
                </div>


                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection