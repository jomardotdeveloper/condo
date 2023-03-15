@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Main', 'url' => 'javascript:void(0);'),
        array('name' => 'Dashboard', 'url' => route('payments.index')),
    ]"/>
</div>
@endsection