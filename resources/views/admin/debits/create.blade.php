@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('debits.index')),
        array('name' => 'Create', 'url' => route('debits.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Invoice" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('debits.store') }}" class="row" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ $_GET['type'] }}" />

               
                <div class="col-6">
                    <x-input name="due_date" label="Due Date" type="date" :is-required="true"/>
                </div>


                {{-- MONTHLY DUES --}}
                @if ($_GET['type'] == 3)
                    <div class="col-6">
                        <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                    </div>
                @endif

                {{-- MOVE IN --}}
                @if ($_GET['type'] == 1)
                    <div class="col-6">
                        <x-select name="application_id" label="Application" :options="$applications" :is-required="true"/>
                    </div>
                    <div class="col-6">
                        <x-input name="move_in_fee" label="Move In Fee" type="number" :is-required="true"/>
                    </div>
                @endif

                {{-- MOVE OUTS --}}
                @if ($_GET['type'] == 2)
                    <div class="col-6">
                        <x-select name="move_out_id" label="Move Out" :options="$move_outs" :is-required="true"/>
                    </div>
                    <div class="col-6">
                        <x-input name="move_out_fee" label="Move Out Fee" type="number" :is-required="true"/>
                    </div>
                @endif

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

