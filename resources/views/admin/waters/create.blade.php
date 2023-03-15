@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Water Readings', 'url' => route('waters.index')),
        array('name' => 'Create', 'url' => route('departments.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Water Reading" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('waters.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                </div>
                
                <div class="col-6">
                    <x-input name="date_from" label="From" type="date" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="date_to" label="To" type="date" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="reading" label="Reading" type="number" :is-required="true"/>
                </div>
                

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection