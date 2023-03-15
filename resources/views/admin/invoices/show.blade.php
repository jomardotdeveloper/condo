@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('invoices.index')),
        array('name' => 'View', 'url' => route('invoices.create')),
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
                                <h4 class="title">{{ $invoice->invoice_to }}</h4>
                                <ul class="list-plain">
                                    <li><em class="icon ni ni-map-pin-fill"></em><span>{{ $invoice->invoice_to_address }}</span></li>
                                    <li><em class="icon ni ni-call-fill"></em><span>{{ $invoice->invoice_to_contact }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="invoice-desc">
                            <h3 class="title">Invoice</h3>
                            <ul class="list-plain">
                                <li class="invoice-id"><span>Invoice ID</span>:<span>{{ $invoice->formatted_id }}</span></li>
                                <li class="invoice-date"><span>Due Date</span>:<span>{{  $invoice->due_date }}</span></li>
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
                                    @foreach ($invoice->lines_array as $line)
                                    <tr>
                                        <td>{{ $line->label }}</td>
                                        <td>₱ {{ number_format($line->amount, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Grand Total</td>
                                        <td>{{ $invoice->formatted_total_amount }}</td>
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


