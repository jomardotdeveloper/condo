@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Tickets', 'url' => route('tickets.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Tickets" description="You have {{ count($tickets) }} tickets"/>

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('tickets.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit Owner/Tenant</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Assignee</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Subject</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $ticket->user->application->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $ticket->employee ? $ticket->employee->full_name : 'N/A' }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $ticket->subject }}
                        </td>
                        <td class="nk-tb-col">
                            {{ App\Models\Ticket::STATUS[$ticket->status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('tickets.show', $ticket), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('tickets.edit', $ticket), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('tickets.destroy', ['ticket' => $ticket]) . '`' .')', 
                                  'icon'=> 'icon ni ni-trash'),
                        ]"/>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection