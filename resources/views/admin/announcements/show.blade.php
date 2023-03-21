@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Announcements', 'url' => route('announcements.index')),
        array('name' => 'View', 'url' => route('announcements.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Announcement" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <h3>{{ $announcement->title }}</h3>
            {!! $announcement->description  !!}
        </div>
    </div>
</div>

@endsection
