@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Settings', 'url' => 'javascript:void(0);'),
        array('name' => 'Positions', 'url' => route('positions.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Positions" description="You have {{ count($positions) }} positions"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('positions.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

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
                    @foreach ($positions as $position)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $position->name }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('positions.edit', $position), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('positions.destroy', ['position' => $position]) . '`' .')', 
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