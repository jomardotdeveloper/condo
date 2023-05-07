@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Main', 'url' => 'javascript:void(0);'),
        array('name' => 'Dashboard', 'url' => route('payments.index')),
    ]"/>

    <div class="row g-gs">  
        <div class="col-xxl-12 col-md-12">
            <div class="card h-100">
                <div class="card-inner">
                    <div class="card-title-group mb-2">
                        <div class="card-title">
                            <h6 class="title">Metrics</h6>
                        </div>
                    </div>
                    <ul class="nk-store-statistics">
                        <li class="item">
                            <div class="info">
                                <div class="title">Invoices</div>
                                <div class="count">{{ $debits }}</div>
                            </div>
                            <em class="icon bg-primary-dim icon ni ni-file-docs"></em>
                        </li>
                        @if (auth()->user()->user_type == 2)
                        <li class="item">
                            <div class="info">
                                <div class="title">Clusters</div>
                                <div class="count">{{ $clusters }}</div>
                            </div>
                            <em class="icon bg-info-dim ni ni-building"></em>
                        </li>
                        <li class="item">
                            <div class="info">
                                <div class="title">Units</div>
                                <div class="count">{{ $units }}</div>
                            </div>
                            <em class="icon bg-pink-dim ni ni-box"></em>
                        </li>
                        @endif
                        <li class="item">
                            <div class="info">
                                <div class="title">Guests</div>
                                <div class="count">{{ $guests }}</div>
                            </div>
                            <em class="icon bg-purple-dim ni ni-users-fill"></em>
                        </li>

                        <li class="item">
                            <div class="info">
                                <div class="title">Deliveries</div>
                                <div class="count">{{ $deliveries }}</div>
                            </div>
                            <em class="icon bg-purple-dim ni ni-server"></em>
                        </li>

                        <li class="item">
                            <div class="info">
                                <div class="title">Tickets</div>
                                <div class="count">{{ $tickets }}</div>
                            </div>
                            <em class="icon bg-purple-dim ni ni-ticket-fill"></em>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection