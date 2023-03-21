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
    <x-datatable-head title="View Application ({{ $application->status_name }})" /> 

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- BUTTONS --}}
    
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#attachment-create-modal">
        Add Attachment
    </button>

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
        @if(count($application->debit->subscriptions) > 0)
        <a href="#" class="btn btn-primary mb-2">Show Payments</a>
        @else
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#payment-create-modal">
            Create Payment
        </button>
        @endif
    @endif

    @if($application->status == App\Models\Application::FINANCE_VERIFICATION)
    @if(count($application->debit->subscriptions) > 0)
    <a href="{{ route('subscriptions.index') }}?debit_id={{ $application->debit->id }}" class="btn btn-primary mb-2">Show Payments</a>
    @endif
    @endif

    @if($application->status == App\Models\Application::LOBBY_GUARD)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#user-create-modal">
        Create User Account
    </button>
    @endif

    {{-- SIGNATORY BUTTONS --}}
    @if (in_array(auth()->user()->employee->id, $application->moveIn->signatories))
    
        @if (auth()->user()->employee->id == $application->moveIn->approved_by_id && !$application->moveIn->approved_is_signed)
        <a href="{{ route('applications.signature', ['application_id' => $application->id, 'field' => 'approved_is_signed']) }}" class="btn btn-primary mb-2">Sign</a>
        @endif

        @if (auth()->user()->employee->id == $application->moveIn->verified_by_id && !$application->moveIn->verified_is_signed)
        <a href="{{ route('applications.signature', ['application_id' => $application->id, 'field' => 'verified_is_signed']) }}" class="btn btn-primary mb-2">Sign</a>
        @endif

        @if (auth()->user()->employee->id == $application->moveIn->cleared_by_id && !$application->moveIn->cleared_is_signed)
        <a href="{{ route('applications.signature', ['application_id' => $application->id, 'field' => 'cleared_is_signed']) }}" class="btn btn-primary mb-2">Sign</a>
        @endif

        @if (auth()->user()->employee->id == $application->moveIn->noted_by_id && !$application->moveIn->noted_is_signed)
        <a href="{{ route('applications.signature', ['application_id' => $application->id, 'field' => 'noted_is_signed']) }}" class="btn btn-primary mb-2">Sign</a>
        @endif

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
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem3">Attachments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tabItem4">Signatures</a>
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
                <div class="tab-pane" id="tabItem3">
                    <div class="row">
                        @include('admin.applications.show-attachment')
                    </div>
                </div>
                <div class="tab-pane" id="tabItem4">
                    <div class="row">
                        <div class="col-6">
                            <h6>Cleared By:</h6>
                            @if ($application->moveIn->cleared_is_signed)
                            <img src="{{ $application->moveIn->clearedBy->signature_src }}" alt="signature" width="100px" height="100px"> <br/>
                            @else
                            <span class="lead">No Signature</span> <br/>
                            @endif
                            <strong><span class="lead">{{ $application->moveIn->clearedBy->full_name }}</span></strong>
                            <strong><span class="lead">Administrative Officer</span></strong>
                        </div>
                        <div class="col-6">
                            <h6>Checked and Verified By:</h6>
                            @if ($application->moveIn->verified_is_signed)
                            <img src="{{ $application->moveIn->verifiedBy->signature_src }}" alt="signature" width="100px" height="100px"> <br/>
                            @else
                            <span class="lead">No Signature</span> <br/>
                            @endif
                            <strong><span class="lead">{{ $application->moveIn->verifiedBy->full_name }}</span></strong>
                            <strong><span class="lead">Finance Department</span></strong>
                        </div>
                        <div class="col-6 mt-2">
                            <h6>Approved By:</h6>
                            @if ($application->moveIn->approved_is_signed)
                            <img src="{{ $application->moveIn->approvedBy->signature_src }}" alt="signature" width="100px" height="100px"> <br/>
                            @else
                            <span class="lead">No Signature</span> <br/>
                            @endif
                            <strong><span class="lead">{{ $application->moveIn->approvedBy->full_name }}</span></strong>
                            <strong><span class="lead">Executive AO/ Complex Manager</span></strong>
                        </div>
                        <div class="col-6  mt-2">
                            <h6>Noted By:</h6>
                            @if ($application->moveIn->noted_is_signed)
                            <img src="{{ $application->moveIn->notedBy->signature_src }}" alt="signature" width="100px" height="100px"> <br/>
                            @else
                            <span class="lead">No Signature</span> <br/>
                            @endif
                            <strong><span class="lead">{{ $application->moveIn->notedBy->full_name }}</span></strong>
                            <strong><span class="lead">Security Office</span></strong>
                        </div>
                        {{-- @include('admin.applications.show-attachment') --}}
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


<x-modal id="attachment-create-modal" title="Add Attachment" footer="Attachment">
    <form action="{{ route('applications.store-attachment') }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="application_id" value="{{ $application->id }}"/>
        <input type="hidden" name="status" value="{{ $application->status }}"/>
        <div class="col-12">
            <x-input name="name" label="Name" type="text"  :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="path" label="File" type="file" :is-required="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
</x-modal>



@endsection


