@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Tickets', 'url' => route('tickets.index')),
        array('name' => 'Edit', 'url' => route('settings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Ticket" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('tickets.update', ['ticket' => $ticket]) }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if(auth()->user()->user_type == App\Models\User::ADMIN)
                <div class="col-6 mt-2">
                    <x-select name="employee_id" label="Employee" :options="$employees" :is-required="true" :default-value="$ticket->employee_id"/>
                </div>
                <div class="col-6 mt-2">
                    <x-select name="user_id" label="User" :options="$users" :is-required="true" :default-value="$ticket->user_id"/>
                </div>
                @endif

                <div class="col-6">
                    <x-input name="subject" label="Subject" type="text" :is-required="true" :default-value="$ticket->subject"/>
                </div>

                <div class="col-6">
                    <x-input name="attachment" label="Update Attachment" type="file" />
                </div>

                <div class="col-12 mt-2">
                    <textarea class="form-control" name="description" required>{{ $ticket->description }}</textarea>
                </div>
                

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection