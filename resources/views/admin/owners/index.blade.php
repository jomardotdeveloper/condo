@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'List of owners', 'url' => 'javascript:void(0);'),
        array('name' => 'Owners', 'url' => route('owners.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Owners" description="You have {{ count($owners) }} owners"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Cluster</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Full Name</span></th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($owners as $owner)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $owner->unit->unit_number }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $owner->unit->cluster->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $owner->full_name }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection