@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Cash Flow', 'url' => route('entries.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Cash Flow" description="You have {{ count($entries) }} entries"/>
    <h5>NET : ₱ {{ number_format($net, 2) }}  </h5>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('entries.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Account</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Account Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Bank</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Reference</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Amount</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Source Document</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($entries as $entry)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $entry->account->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $entry->account->is_in ? 'Cash In' : 'Cash Out' }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $entry->bank ? $entry->bank->name : '' }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $entry->reference }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $entry->amount }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $entry->source_document }}
                        </td>
                        <x-datatable-action :items="[
                            array('name' => 'Edit', 'url' => route('entries.edit', $entry), 'icon'=> 'icon ni ni-pen'),
                            array('name' => 'Delete', 
                                  'onclick' => 'deleteRecord(' . '`' . route('entries.destroy', ['entry' => $entry]) . '`' .')', 
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