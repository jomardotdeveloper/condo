@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('dealers.index')),
        array('name' => 'Create', 'url' => route('dealers.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Vendor" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('dealers.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @include('admin.dealers.form')
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection