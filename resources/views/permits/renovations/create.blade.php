@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Permits', 'url' => 'javascript:void(0);'),
        array('name' => 'Renovations', 'url' => route('renovations.index')),
        array('name' => 'Create', 'url' => route('renovations.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Record" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('renovations.store') }}" method="POST" class="row">
                @csrf
                @include('permits.renovations.form')
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
