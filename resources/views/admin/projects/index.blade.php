@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Projects', 'url' => route('projects.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Projects" description="You have {{ count($projects) }} projects"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('projects.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Project Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Winner</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Budget</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Approved</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($projects as $project)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $project->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $project->dealer_id ? $project->dealer->organization_name : 'N/A' }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $project->budget }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $project->is_approved ? 'Yes' : 'No' }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'View', 'url' => route('projects.show', $project), 'icon'=> 'icon ni ni-eye'),
                            array('name' => 'Edit', 'url' => route('projects.edit', $project), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('projects.destroy', ['project' => $project]) . '`' .')', 
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