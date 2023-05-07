@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Invoices', 'url' => route('debits.index')),
        array('name' => 'View', 'url' => route('debits.create')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="View Invoice" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- BUTTONS --}}
    @if (!$debit->is_paid)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#payment-create-modal">
        Pay
    </button>
    @endif
    


    <div class="card">
        <div class="card-inner">
            <div class="invoice">
                <div class="invoice-wrap">
                    {{-- LOGO --}}
                    <div class="invoice-brand text-center">
                        <img src="{{ asset('admin/images/cgs.png') }}" srcset="{{ asset('admin/images/cgs.png') }} 4x" alt="">
                    </div>
                    <div class="invoice-head">
                        <div class="invoice-contact">
                            <span class="overline-title">Invoice To</span>
                            <div class="invoice-contact-info">
                                <h4 class="title">{{ $debit->customer_name }}</h4>
                            </div>
                        </div>
                        <div class="invoice-desc">
                            <h3 class="title">Invoice</h3>
                            <ul class="list-plain">
                                <li class="invoice-id"><span>Invoice ID</span>: {{ $debit->formatted_id }}<span></span></li>
                                <li class="invoice-date"><span>Due Date</span>: {{ $debit->due_date }}<span></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-bills">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                {{-- <h1>{{ $debit->type == 0 }}</h1> --}}
                                <tbody>
                                    @if ($debit->type == 1)
                                        <tr>
                                            <td>Move In Fee</td>
                                            <td>{{ $debit->formatted_total_amount }}</td>
                                        </tr>
                                    @elseif($debit->type == 2)
                                        <tr>
                                            <td>Move Out Fee</td>
                                            <td>{{ $debit->formatted_total_amount }}</td>
                                        </tr>
                                    @endif

                                    @if($debit->type == 3)
                                        <tr>
                                            <td>Monthly Due Fee</td>
                                            <td>{{ $debit->monthly_due_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Electricity Fee</td>
                                            <td>{{ $debit->electric_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Water Fee</td>
                                            <td>{{ $debit->water_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Parking Fee</td>
                                            <td>{{ $debit->parking_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Penalty</td>
                                            <td>{{ $debit->penalty_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Recollection Fee</td>
                                            <td>{{ $debit->recollection_fee }}</td>
                                        </tr>
                                        <tr>
                                            <td>Other</td>
                                            <td>{{ $debit->other_fee }}</td>
                                        </tr>
                                        <tr>HAHA</tr>
                                    @endif
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>{{ $debit->formatted_total_amount }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seal. </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal id="payment-create-modal" title="Create Payment" footer="Payment">
    <form action="{{ route('user-debits.store-payment') }}" class="row" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="debit_id" value="{{ $debit->id }}"/>
        <input type="hidden" name="payment_status" value="1"/>
        <input type="hidden" name="payment_method" value="Online Transfer"/>
        
        <div class="col-12">
            <x-input name="proof_of_payment_src" label="Proof of Payment (Required)" type="file" :is-required="true"/>
        </div>

        <div class="col-12">
            <x-input name="amount" label="Amount" type="number" :default-value="$debit->total_amount" :is-required="true" :is-readonly="true"/>
        </div>

        <div class="col-12 mt-2">
            <button type="submit" class="btn btn-primary">Send Payment</button>
        </div>
    </form>
</x-modal>

@endsection


