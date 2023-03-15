@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Banks', 'url' => route('banks.index')),
        array('name' => 'Create', 'url' => route('banks.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Bank" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('banks.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-input name="name" label="Name" type="text" :is-required="true"/>
                </div>
                <div class="col-6">
                    <x-input name="account_no" label="Account #" type="text" :is-required="true"/>
                </div>
                <div class="col-6">
                    <x-input name="account_name" label="Account Name" type="text" :is-required="true"/>
                </div>
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection