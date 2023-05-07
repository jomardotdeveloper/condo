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
                        <x-select name="user_id" label="User" :options="$users" :is-required="true" :is-readonly="true" :default-value="$debit->user_id"/>
                    </div>
                    <div class="col-6">
                        <x-input name="parking_fee" label="Parking Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$debit->parking_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="monthly_due_fee" label="Monthly Due Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$debit->monthly_due_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="electric_fee" label="Electricity Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$debit->electric_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="water_fee" label="Water Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$debit->water_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="penalty_fee" label="Penalty" type="number" :is-required="true" :default-value="$debit->penalty_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="recollection_fee" label="Recollection Fee" type="number" :is-required="true" :default-value="$debit->recollection_fee"/>
                    </div>
                    <div class="col-6">
                        <x-input name="other_fee" label="Other" type="number" :is-required="true" :default-value="$debit->other_fee"/>
                    </div>
                    <div class="col-6">
                        <x-select name="show_in_portal" label="Show In Portal" :options="[['id' => 1, 'name' => 'YES'], ['id' => 2, 'name' => 'NO']]"  :is-required="true" :default-value="$debit->show_in_portal ? 1 : 2"/>
                    </div>

                    <div class="col-6">
                        <x-input name="description" label="Internal Notes" type="text" :default-value="$debit->description"/>
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

