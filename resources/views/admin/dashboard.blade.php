@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Main', 'url' => 'javascript:void(0);'),
        array('name' => 'Dashboard', 'url' => route('payments.index')),
    ]"/>

    <div class="row g-gs">  
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Invoices</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $debits }}</div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2><em class="bg-primary-dim icon ni ni-file-docs p-1 rounded"></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        @if (auth()->user()->user_type == 2)
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Clusters</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $clusters }}</div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2> <em class="icon bg-info-dim ni ni-building p-1 rounded"></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Units</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $units }}</div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2><em class="icon bg-pink-dim ni ni-box p-1 rounded"></em></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        @endif
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Guests</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $guests }} </div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2><em class="icon bg-purple-dim ni ni-users-fill p-1 rounded"></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Deliveries</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $deliveries }}</div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2><em class="icon bg-purple-dim ni ni-server p-1 rounded"></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-xxl-3 col-sm-3">
            <div class="card">
                <div class="nk-ecwg nk-ecwg6">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Tickets</h6>
                            </div>
                        </div>
                        <div class="data">
                            <div class="data-group">
                                <div class="amount">{{ $tickets  }}</div>
                                <div class="nk-ecwg6-ck ml-5">
                                    <h2><em class="icon bg-purple-dim ni ni-ticket-fill p-1 rounded"></em></h2>
                                    <canvas class="ecommerce-line-chart-s3" id="todayOrders"></canvas>
                                </div>
                            </div>
                            {{-- <div class="info"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><span> vs. last week</span></div> --}}
                        </div>
                    </div><!-- .card-inner -->
                </div><!-- .nk-ecwg -->
            </div><!-- .card -->
        </div><!-- .col -->
        <div class="col-lg-12 col-xxl-12">
            <div class="card">
                <div class="card-inner">
                    <div class="card-title-group align-start mb-2">
                        <div class="card-title">
                            <h6 class="title">Latest Announcement</h6>
                            @if (!$latestAnnouncement)
                            <p class="text-danger">No announcement yet.</p>
                            @else
                            <p class="text-success">Latest announcement.</p>
                            @endif
                            {{-- <div class="card-tools">
                                <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
                            </div> --}}
                        </div>
                        
                    </div>
                    <div class="card-title-group align-start mb-2">
                        <div class="card-title">
                            <h6 class="title">{{ $latestAnnouncement->title }}</h6>
                           
                        </div>
                    </div>
                    {!! $latestAnnouncement->description  !!}
    
                </div>
            </div>
        </div><!-- .col -->
    </div>
</div>
@endsection