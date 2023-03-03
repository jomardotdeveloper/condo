@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Departments', 'url' => route('departments.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Departments" description="You have {{ count($departments) }} departments"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('departments.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($departments as $department)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $department->name }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('departments.edit', $department), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('departments.destroy', ['department' => $department]) . '`' .')', 
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