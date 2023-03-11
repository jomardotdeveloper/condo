@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Move In', 'url' => 'javascript:void(0);'),
        array('name' => $title, 'url' => route('departments.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Applications" description="You have {{ count($applications) }} applications"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('applications.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Resident Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Date of Move-In</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($applications as $application)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $application->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $application->moveIn->move_in_date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $application->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.application_status')[$application->status] }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('applications.show', $application), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('applications.edit', $application), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('applications.destroy', ['application' => $application]) . '`' .')', 
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