@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Human Resources', 'url' => 'javascript:void(0);'),
        array('name' => 'Attendances', 'url' => route('attendances.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Attendances" description="You have {{ count($attendances) }} attendances"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- TIME-in/TIME-out BUTTON --}}

    @if(!auth()->user()->has_active_leave)
        @if(!auth()->user()->has_time_in)
            <a href="{{ route('attendances.time-in') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Time In</a>
        @else
            @if(!auth()->user()->has_time_out)
                <a href="{{ route('attendances.time-out') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2">Time Out</a>
            @endif
        @endif
    @endif

    
    

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Employee</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Time In</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Time Out</span></th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($attendances as $attendance)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $attendance->user->employee->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $attendance->date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $attendance->time_in }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $attendance->time_out }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection