@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Employees', 'url' => route('employees.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Employees" description="You have {{ count($employees) }} employees"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('employees.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Full Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Position</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Department</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($employees as $employee)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $employee->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $employee->position->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $employee->department->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $employee->user->email }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('employees.edit', $employee), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('employees.destroy', ['employee' => $employee]) . '`' .')', 
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