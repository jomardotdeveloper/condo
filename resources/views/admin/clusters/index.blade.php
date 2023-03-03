@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Clusters', 'url' => route('clusters.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Clusters" description="You have {{ count($clusters) }} clusters"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('clusters.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Name</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Bills day reading</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Due date interval</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Tower</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($clusters as $cluster)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $cluster->name }}
                        </td>

                        <td class="nk-tb-col">
                            {{ $cluster->reading_day }}
                        </td>

                        <td class="nk-tb-col">
                            {{ $cluster->due_date }}
                        </td>

                        <td class="nk-tb-col">
                            {{ $cluster->unit_towers }}
                        </td>

                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('clusters.edit', $cluster), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('clusters.destroy', ['cluster' => $cluster]) . '`' .')', 
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