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
                        <x-select name="user_id" label="User" :options="$users" :is-required="true" :default-value="$user ? $user->id : ''"/>
                    </div>
                    <div class="col-6">
                        <x-input name="parking_fee" label="Parking Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$user ? $user->parking_fee : 0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="monthly_due_fee" label="Monthly Due Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$user ? $user->monthly_due_fee : 0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="electric_fee" label="Electricity Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$user ? $user->electric_fee : 0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="water_fee" label="Water Fee" type="number" :is-required="true" :is-readonly="true" :default-value="$user ? $user->water_fee : 0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="penalty_fee" label="Penalty" type="number" :is-required="true" :default-value="$user ? $user->penalty_fee : 0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="other_fee" label="Other" type="number" :is-required="true" :default-value="0"/>
                    </div>
                    <div class="col-6">
                        <x-input name="description" label="Internal Notes" type="text" />
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
@push('scripts')
    <script>
        $('#user_id').on('change', function(){
            window.location.href = "{{ route('debits.create') }}?type=3&user_id=" + $(this).val();
        });
    </script>
@endpush

