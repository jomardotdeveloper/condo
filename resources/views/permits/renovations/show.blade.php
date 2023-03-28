@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Permits', 'url' => 'javascript:void(0);'),
        array('name' => 'Renovations', 'url' => route('renovations.index')),
        array('name' => 'View', 'url' => route('renovations.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Record" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="row">
                <x-show-item label="Date" value="{{ $renovation->date }}"/>
                <x-show-item label="Resident's Name" value="{{ $renovation->user->email }}"/>
                <x-show-item label="Unit" value="{{ $renovation->unit->unit_number }}"/>
                <x-show-item label="Start of Renovation" value="{{ $renovation->renovation_start_date }}"/>
                <x-show-item label="Contractor" value="{{ $renovation->vendor->company_name }}"/>
                <div class="nk-block">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Submitted Requirements</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (App\Models\Renovation::REQUIREMENT_CHECKLISTS as $key => $val )
                                        @if(in_array(strval($key), $renovation->requirement_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Refundable Construction Bond</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (App\Models\Renovation::REFUNDABLE_CHECKLISTS as $key => $val )
                                        @if(in_array(strval($key), $renovation->refundable_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Workers Identification Card Issuance Form</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (App\Models\Renovation::WORKERS_IDENTIFICATION_CHECKLISTS as $key => $val )
                                        @if(in_array(strval($key), $renovation->workers_identification_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">Checklists prior to renovation date</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (App\Models\Renovation::PRIOR_CHECKLISTS as $key => $val )
                                        @if(in_array(strval($key), $renovation->prior_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="nk-block-head nk-block-head-sm nk-block-between">
                                <h5 class="title">REFUND OF THE CONSTRUCTION BOND</h5>
                            </div>
                            <ul class="g-1">
                                @foreach (App\Models\Renovation::CONSTRUCTION_BOND_CHECKLISTS as $key => $val )
                                        @if(in_array(strval($key), $renovation->construction_bond_checklists_arr))
                                        <li class="btn-group">
                                            <a class="btn btn-xs btn-light btn-dim" href="javascript:void(0);">{{ $val }}</a>
                                        </li>
                                        @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
