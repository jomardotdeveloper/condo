@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Human Resources', 'url' => 'javascript:void(0);'),
        array('name' => 'Leaves', 'url' => route('leaves.index')),
        array('name' => 'Edit', 'url' => route('leaves.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Leave" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('leaves.update', ['leaf' => $leave]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-input name="start_date" label="Start Date" type="date" :is-required="true" :default-value="$leave->start_date"/>
                </div>

                <div class="col-6">
                    <x-input name="end_date" label="End Date" type="date" :is-required="true" :default-value="$leave->end_date"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="leave_type_id" label="Leave Type" :options="$leave_types" :is-required="true" :default-value="$leave->leave_type_id"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="remarks" label="Remarks" type="text" :default-value="$leave->remarks"/>
                </div>

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection