@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Inventory', 'url' => 'javascript:void(0);'),
        array('name' => 'Supplier Items', 'url' => route('supplier-items.index')),
        array('name' => 'Create', 'url' => route('supplier-items.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Supplier Item" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('supplier-items.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-select name="vendor_id" label="Supplier" :options="$vendors" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="lines" label="Items (Separated by comma)" type="text" :is-required="true"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection