@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Accounts', 'url' => route('accounts.index')),
        array('name' => 'Create', 'url' => route('accounts.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Account" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('accounts.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-input name="code" label="Code" type="text" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="name" label="Name" type="text" :is-required="true"/>
                </div>
                
                <div class="col-6">
                    <x-select name="is_in" label="Type" :options="$types" :is-required="true"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection