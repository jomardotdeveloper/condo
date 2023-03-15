@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => 'Applications', 'url' => route('applications.index')),
        array('name' => 'View', 'url' => route('applications.create')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="View Application" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- BUTTONS --}}
    @if($application->status == App\Models\Application::NEW_APPLICATION && !$application->debit)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#invoice-create-modal">
        Create Invoice
    </button>
    @endif

    @if($application->debit)
    <a href="{{ route('debits.show', ['debit' => $application->debit]) }}" class="btn btn-primary mb-2" >
        Show Invoice
    </a>
    @endif

    @if($application->status == App\Models\Application::FOR_PAYMENT)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#payment-create-modal">
        Create Payment
    </button>
    @endif

    @if($application->status == App\Models\Application::LOBBY_GUARD)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#user-create-modal">
        Create User Account
    </button>
    @endif
    
    <div class="card">
        <div class="card-inner">
            <ul class="nav nav-tabs mt-n4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tabItem1">Move In Clearance Form</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem2">Resident's Information Sheet</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabItem1">
                    <div class="row">
                        @include('admin.applications.show-move-in-clearance')
                    </div>
                </div>
                <div class="tab-pane" id="tabItem2">
                    <div class="row">
                        @include('admin.applications.show-resident-information')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INVOICE CREATE MODAL --}}
<x-modal id="invoice-create-modal" title="Create Invoice" footer="Invoice">
    <form action="{{ route('applications.store-invoice') }}" class="row" method="POST">
        @csrf
        <input type="hidden" name="customer_name" value="{{ $application->full_name }}"/>
        <input type="hidden" name="application_id" value="{{ $application->id }}"/>

        <div class="col-12">
            <x-input name="due_date" label="Due Date" type="date" :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="move_in_fee" label="Move In Fee" type="number" :is-required="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</x-modal>


{{-- USER CREATE MODAL --}}
<x-modal id="user-create-modal" title="Create User" footer="User">
    <form action="{{ route('applications.store-user') }}" class="row" method="POST">
        @csrf
        <input type="hidden" name="application_id" value="{{ $application->id }}"/>

        <div class="col-12">
            <x-input name="email" label="Email" type="email" :default-value="$application->residentInformation->email" :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="password" label="Password" type="password" :is-required="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</x-modal>


{{-- PAYMENT CREATE MODAL --}}
<x-modal id="payment-create-modal" title="Create Payment" footer="Payment">
    <form action="{{ route('applications.store-payment') }}" class="row" method="POST">
        @csrf
        <input type="hidden" name="application_id" value="{{ $application->id }}"/>
        <input type="hidden" name="debit_id" value="{{ $application->debit ? $application->debit->id : '' }}"/>
        <input type="hidden" name="payment_status" value="2"/>

        <div class="col-12">
            <x-input name="payment_method" label="Payment Method" type="text"  />
        </div>

        <div class="col-12">
            <x-input name="payment_reference" label="Payment Reference" type="text" />
        </div>

        <div class="col-12">
            <x-input name="amount" label="Amount" type="number" :default-value="$application->debit ? $application->debit->total_amount : ''" :is-required="true" :is-readonly="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</x-modal>



@endsection


