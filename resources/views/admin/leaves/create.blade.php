@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Human Resources', 'url' => 'javascript:void(0);'),
        array('name' => 'Leaves', 'url' => route('leaves.index')),
        array('name' => 'Create', 'url' => route('leaves.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Leave" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('leaves.store') }}" class="row" method="POST">
                @csrf
                <div class="col-6">
                    <x-input name="start_date" label="Start Date" type="date" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="end_date" label="End Date" type="date" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="leave_type_id" label="Leave Type" :options="$leave_types" :is-required="true"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="remarks" label="Remarks" type="text" />
                </div>


                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection