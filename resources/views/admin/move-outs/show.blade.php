@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move Out', 'url' => 'javascript:void(0);'),
        array('name' => 'Move Outs', 'url' => route('move-outs.index')),
        array('name' => 'View', 'url' => route('applications.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Move Out" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- BUTTONS --}}
    @if($move_out->status == App\Models\Application::NEW_APPLICATION && !$move_out->debit)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#invoice-create-modal">
        Create Invoice
    </button>
    @endif

    @if($move_out->debit)
    <a href="{{ route('debits.show', ['debit' => $move_out->debit]) }}" class="btn btn-primary mb-2" >
        Show Invoice
    </a>
    @endif

    @if($move_out->status == App\Models\Application::FOR_PAYMENT)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#payment-create-modal">
        Create Payment
    </button>
    @endif

    @if($move_out->status == App\Models\Application::LOBBY_GUARD)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#user-create-modal">
        Create User Account
    </button>
    @endif

    <div class="card">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">MOVE-OUT CLEARANCE FORM</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Date of Move out" value="{{ $move_out->move_out_date }}"/>
                            <x-show-item label="Residen't name" value="{{ $move_out->full_name }}"/>
                            <x-show-item label="Unit Owner" :value="$move_out->is_owner ? 'YES' : 'NO'"/>
                            <x-show-item label="Tenant" :value="!$move_out->is_owner ? 'YES' : 'NO'"/>
                            <x-show-item label="Requested By" value="{{ $move_out->requested_by }}"/>
                            <x-show-item label="Approved By" value="{{ $move_out->approved_by }}"/>
                            <x-show-item label="Cleared By" value="{{ $move_out->cleared_by }}"/>
                            <x-show-item label="Checked and Verified By" value="{{ $move_out->verified_by }}"/>
                            <x-show-item label="Noted By" value="{{ $move_out->noted_by }}"/>
                            <x-show-item label="Additional Instruction by the unit owner, if any:" value="{{ $move_out->additional_instruction }}"/>
                        </div>
                        <div class="nk-divider divider md"></div>
                        <div class="col-12 mt-2">
                            <h6>Items to be PULLED-OUT</h6>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col"> QUANTITIES</th>
                                        <th scope="col"> NAMES</th>
                                        <th scope="col">DESCRIPTIONS</th>
                                        <th scope="col"> REMARKS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 10; $i++)
                                        <tr>
                                            <td>
                                               {{$move_out->item_quantities_arr[$i]}}
                                            </td>
                                            <td>
                                                {{$move_out->item_names_arr[$i]}}
                                            </td>
                                            <td>
                                                {{$move_out->item_descriptions_arr[$i]}}
                                            </td>
                                            <td>
                                               {{ $move_out->item_remarks_arr[$i]}}
                                            </td>
                                        </tr>
                                    @endfor
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="nk-divider divider md"></div>
                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">LIST OF CHARGES BILLED</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (config('checklists.move_out_charges_checklists') as $key => $val )
                                        @if(in_array(strval($key), $move_out->charges_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="nk-divider divider md"></div>

                        <div class="col-12">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Additional Instruction by Accounting Department</h5>
                            </div>
                            <p>{{ $move_out->additional_instruction_by_accounting ? $move_out->additional_instruction_by_accounting : "N/A" }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- INVOICE CREATE MODAL --}}
<x-modal id="invoice-create-modal" title="Create Invoice" footer="Invoice">
    <form action="{{ route('move-outs.store-invoice') }}" class="row" method="POST">
        @csrf
        <input type="hidden" name="move_out_id" value="{{ $move_out->id }}"/>
        
        <input type="hidden" name="customer_name" value="{{ $move_out->full_name }}"/>
        <div class="col-12">
            <x-input name="due_date" label="Due Date" type="date" :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="move_out_fee" label="Move Out Fee" type="number" :is-required="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</x-modal>

{{-- PAYMENT CREATE MODAL --}}
<x-modal id="payment-create-modal" title="Create Payment" footer="Payment">
    <form action="{{ route('move-outs.store-payment') }}" class="row" method="POST">
        @csrf
        <input type="hidden" name="move_out_id" value="{{ $move_out->id }}"/>
        <input type="hidden" name="debit_id" value="{{ $move_out->debit ? $move_out->debit->id : '' }}"/>
        <input type="hidden" name="payment_status" value="2"/>

        <div class="col-12">
            <x-input name="payment_method" label="Payment Method" type="text"  />
        </div>

        <div class="col-12">
            <x-input name="payment_reference" label="Payment Reference" type="text" />
        </div>

        <div class="col-12">
            <x-input name="amount" label="Amount" type="number" :default-value="$move_out->debit ? $move_out->debit->total_amount : ''" :is-required="true" :is-readonly="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</x-modal>


@endsection
