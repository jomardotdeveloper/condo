@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('debits.index')),
        array('name' => 'View', 'url' => route('debits.create')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="View Invoice" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-inner">
            <div class="invoice">
                <div class="invoice-wrap">
                    {{-- LOGO --}}
                    <div class="invoice-brand text-center">
                        <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
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


@endsection


