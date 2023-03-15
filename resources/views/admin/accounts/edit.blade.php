@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Accounts', 'url' => route('accounts.index')),
        array('name' => 'Edit', 'url' => route('accounts.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Account" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('accounts.update', ['account' => $account]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-input name="code" label="Code" type="text" :is-required="true" :default-value="$account->code"/>
                </div>
                
                <div class="col-6">
                    <x-input name="name" label="Name" type="text" :is-required="true" :default-value="$account->name"/>
                </div>
                
                <div class="col-6">
                    <x-select name="is_in" label="Type" :options="$types" :is-required="true" :default-value="$account->is_in ? 1 : 2"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection