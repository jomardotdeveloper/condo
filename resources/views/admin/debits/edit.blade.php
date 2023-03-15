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
            <form action="{{ route('debits.update', ['debit' => $debit]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="{{ $debit->type }}" />

               
                <div class="col-6">
                    <x-input name="due_date" label="Due Date" type="date" :default-value="$debit->due_date" :is-required="true"/>
                </div>


                {{-- MONTHLY DUES --}}
                @if ($debit->type == 3)
                    <div class="col-6">
                        <x-select name="unit_id" label="Unit" :options="$units" :is-required="true"/>
                    </div>
                @endif

                {{-- MOVE IN --}}
                @if ($debit->type == 1)
                    <div class="col-6">
                        <x-input name="move_in_fee" label="Move In Fee" type="number" :default-value="$debit->move_in_fee" :is-required="true"/>
                    </div>
                @endif

                {{-- MOVE OUTS --}}
                @if ($debit->type == 2)
                    <div class="col-6">
                        <x-input name="move_out_fee" label="Move Out Fee" type="number" :default-value="$debit->move_out_fee" :is-required="true"/>
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

