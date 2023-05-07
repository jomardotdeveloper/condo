@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Tickets', 'url' => route('tickets.index')),
        array('name' => 'View', 'url' => route('settings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Ticket" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="row">
                <x-show-item label="Unit Owner/Tenant" value=" {{ $ticket->user->application->full_name }}"/>
                <x-show-item label="Subject" value="{{ $ticket->subject }}"/>
                <x-show-item label="Status" :value="App\Models\Ticket::STATUS[$ticket->status]"/>
                <x-show-item label="Assignee" value="{{ $ticket->employee ? $ticket->employee->full_name : 'N/A' }}"/>
                <div class="nk-divider divider md"></div>
                <div class="col-12 mt-2">
                    <h6>Description</h6> @if ($ticket->attachment) <a href="{{$ticket->attachment }}" download>Download Attachment</a> @endif
                    <p>{{ $ticket->description }}</p>
                </div>

            </div>
            
        </div>
    </div>

    <x-comment model="ticket" :record=" $ticket->id " :comments="$comments" />
</div>

@endsection