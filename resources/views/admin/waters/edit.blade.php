@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Water Readings', 'url' => route('waters.index')),
        array('name' => 'Edit', 'url' => route('departments.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Water Reading" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('waters.update', ['water' => $water]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-select name="unit_id" label="Unit" :options="$units" :is-required="true" :default-value="$water->unit_id"/>
                </div>
                
                <div class="col-6">
                    <x-input name="date_from" label="From" type="date" :is-required="true" :default-value="$water->date_from"/>
                </div>
                
                <div class="col-6">
                    <x-input name="date_to" label="To" type="date" :is-required="true" :default-value="$water->date_to"/>
                </div>

                <div class="col-6">
                    <x-input name="reading" label="Reading" type="number" :is-required="true" :default-value="$water->reading"/>
                </div>
                
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection