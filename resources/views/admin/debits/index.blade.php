@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Finance', 'url' => 'javascript:void(0);'),
        array('name' => 'Invoices', 'url' => route('debits.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Invoices" description="You have {{ count($debits) }} invoices"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('debits.create') }}?type=1"  class="btn btn-primary d-none d-md-inline-flex mb-2">Move In</a>
    <a href="{{ route('debits.create') }}?type=2"  class="btn btn-primary d-none d-md-inline-flex mb-2">Move Out</a>
    <a href="{{ route('debits.create') }}?type=3"  class="btn btn-primary d-none d-md-inline-flex mb-2">Monthly dues</a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">ID</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Total Amount</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Due Date</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Paid</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($debits as $debit)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $debit->formatted_id }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $debit->type_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $debit->total_amount  }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $debit->due_date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $debit->is_paid ? 'Yes' : 'No' }}
                        </td>

                        <?php
                            $actions = [
                                array('name' => 'View', 'url' => route('debits.show', $debit), 'icon'=> 'icon ni ni-eye'),
                                array('name' => 'Edit', 'url' => route('debits.edit', $debit), 'icon'=> 'icon ni ni-pen'),
                                array('name' => 'Delete', 
                                      'onclick' => 'deleteRecord(' . '`' . route('debits.destroy', ['debit' => $debit]) . '`' .')', 
                                      'icon'=> 'icon ni ni-trash'),
                            ];

                            if ($debit->is_paid) {
                                unset($actions[1]);
                                unset($actions[2]);
                            }
                        
                        ?>
                        <x-datatable-action :items="$actions"/>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection