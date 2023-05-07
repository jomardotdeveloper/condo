@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Tickets', 'url' => route('tickets.index')),
        array('name' => 'Create', 'url' => route('settings.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="New Ticket" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('tickets.store') }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf

                @if(auth()->user()->user_type == App\Models\User::ADMIN)
                <div class="col-6 mt-2">
                    <x-select name="employee_id" label="Employee" :options="$employees" :is-required="true"/>
                </div>
                <div class="col-6 mt-2">
                    <x-select name="user_id" label="User" :options="$users" :is-required="true"/>
                </div>
                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$statuses" :is-required="true"/>
                </div>
                @endif

                <div class="col-6">
                    <x-input name="subject" label="Subject" type="text" :is-required="true"/>
                </div>

                <div class="col-6">
                    <x-input name="attachment" label="Attachment" type="file" />
                </div>

                

                <div class="col-12 mt-2">
                    <textarea class="form-control" name="description" required></textarea>
                </div>
                

                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection