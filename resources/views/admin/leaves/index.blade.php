@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Human Resources', 'url' => 'javascript:void(0);'),
        array('name' => 'Leaves', 'url' => route('leaves.index')),
    ]"/>

    {{-- TITLE --}}
    <x-datatable-head title="Leaves" description="You have {{ count($leaves) }} leaves"/>
    
    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    {{-- CREATE BUTTON --}}
    <a href="{{ route('leaves.create') }}"  class="btn btn-primary d-none d-md-inline-flex mb-2"><em class="icon ni ni-plus"></em></a>

    {{-- DATA TABLE --}}
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                {{-- HEAD --}}
                <thead>
                    <tr class="nk-tb-item nk-tb-head">
                        <th class="nk-tb-col"><span class="sub-text">Employee</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Leave Type</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Start</span></th>
                        <th class="nk-tb-col"><span class="sub-text">End</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Remarks</span></th>
                        <th class="nk-tb-col"><span class="sub-text">Status</span></th>
                        <th class="nk-tb-col nk-tb-col-tools text-end">
                        </th>
                    </tr>
                </thead>
                {{-- BODY --}}
                <tbody>
                    @foreach ($leaves as $leave)
                    <tr class="nk-tb-item">
                        <td class="nk-tb-col">
                            {{ $leave->user->employee->full_name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $leave->leaveType->name }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $leave->start_date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $leave->end_date }}
                        </td>
                        <td class="nk-tb-col">
                            {{ $leave->remarks }}
                        </td>
                        <td class="nk-tb-col">
                            {{ config('enums.leave_status')[$leave->status] }}
                        </td>
                        <?php
                            $values = [];   
                            if($leave->status == 1) {
                                $values[] = array('name' => 'Approve', 'url' => route('leaves.approve', $leave), 'icon'=> 'icon ni ni-check');
                                $values[] = array('name' => 'Reject', 'url' => route('leaves.reject', $leave), 'icon'=> 'icon ni ni-cross');
                            }
                            $values[] = array('name' => 'Edit', 'url' => route('leaves.edit', $leave), 'icon'=> 'icon ni ni-pen');
                            $values[] = array('name' => 'Delete', 
                                        'onclick' => 'deleteRecord(' . '`' . route('leaves.destroy',  $leave) . '`' .')', 
                                        'icon'=> 'icon ni ni-trash');
                                    
                                


                            
                        
                        
                        ?>


                        <x-datatable-action :items="$values"/>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- END OF DATATABLE --}}
</div>
@endsection