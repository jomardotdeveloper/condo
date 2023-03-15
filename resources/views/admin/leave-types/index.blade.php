@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Human Resources', 'url' => 'javascript:void(0);'),
        array('name' => 'Leave Types', 'url' => route('leave-types.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Leave Types" description="You have {{ count($leave_types) }} leave types"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('leave-types.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Description</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($leave_types as $type)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $type->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $type->description }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('leave-types.edit', $type), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('leave-types.destroy', ['leave_type' => $type]) . '`' .')', 
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