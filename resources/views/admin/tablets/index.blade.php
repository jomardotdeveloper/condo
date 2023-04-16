<!DOCTYPE html>
<html lang="zxx" class="js">

@include('layouts.admin.head')

<style>
    .block {
        display: block;
        width: 100%;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }
</style>

<body class="nk-body bg-white npc-default pg-error p-5">
    {{-- <div class="nk-block nk-block-middle nk-auth-body mt-5"> --}}
        @if (!isset($_GET['type']))
        <button onclick="goToVisitor()" class="btn btn-success block mt-5" style="height:200px;">Visitors</button>
        <button onclick="goToPackage()" class="btn btn-info block mt-5" style="height:200px;">Package</button>
        @elseif($_GET['type'] == 'visitor')
        <button onclick="goToBack()" class="btn btn-info" >Go Back</button>
        <button onclick="goToCreateVis()" class="btn btn-info" >New Visitor</button>
        <button onclick="goToCreateRe()" class="btn btn-info" >Returnee Visitor</button>
        <div class="card card-bordered card-preview mt-2">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    {{-- HEAD --}}
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">Visitor</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Address</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">ID Presented</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">ID Number Presented</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Unit</span></th>
                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Expected date & time of arrival</span></th>
                            <th class="nk-tb-col nk-tb-col-tools text-end">
                            </th>
                        </tr>
                    </thead>
                    {{-- BODY --}}
                    <tbody>
                        @foreach ($guests as $guest)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $guest->visitor->full_name }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $guest->visitor->address }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $guest->valid_id_name }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $guest->valid_id_number }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $guest->unit->unit_number }}
                            </td>
                            <td class="nk-tb-col tb-col-md">
                                {{ $guest->expected_arrival_date }}
                            </td>
                            <x-datatable-action :items="[
                                array('name' => 'View', 'url' => route('guests.show', $guest), 'icon'=> 'icon ni ni-eye'),
                                array('name' => 'Edit', 'url' => route('guests.edit', $guest), 'icon'=> 'icon ni ni-pen'),
                                array('name' => 'Delete', 
                                      'onclick' => 'deleteRecord(' . '`' . route('guests.destroy', ['guest' => $guest]) . '`' .')', 
                                      'icon'=> 'icon ni ni-trash'),
                            ]"/>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <button onclick="goToBack()" class="btn btn-info" >Go Back</button>
        <button onclick="goToCreateDel()" class="btn btn-info" >New Delivery</button>
        <div class="card card-bordered card-preview mt-2">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    {{-- HEAD --}}
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">Type</span></th>
                            <th class="nk-tb-col"><span class="sub-text">From</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Unit</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Receiver</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Reference number</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Expected date & time of arrival</span></th>
                            <th class="nk-tb-col nk-tb-col-tools text-end">
                            </th>
                        </tr>
                    </thead>
                    {{-- BODY --}}
                    <tbody>
                        @foreach ($deliveries as $delivery)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">
                                {{ $delivery->type_name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $delivery->from }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $delivery->unit->unit_number }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $delivery->receiver_name }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $delivery->reference_number }}
                            </td>
                            <td class="nk-tb-col">
                                {{ $delivery->expected_arrival_date }}
                            </td>
                            <x-datatable-action :items="[
                                array('name' => 'View', 'url' => route('deliveries.show', $delivery), 'icon'=> 'icon ni ni-eye'),
                                array('name' => 'Edit', 'url' => route('deliveries.edit', $delivery), 'icon'=> 'icon ni ni-pen'),
                                array('name' => 'Delete', 
                                      'onclick' => 'deleteRecord(' . '`' . route('deliveries.destroy', ['delivery' => $delivery]) . '`' .')', 
                                      'icon'=> 'icon ni ni-trash'),
                            ]"/>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
    {{-- </div> --}}
</body>

<script>
    function goToVisitor() {
        window.location.href = "{{ route('tablets.index') }}?type=visitor";
    }

    function goToPackage() {
        window.location.href = "{{ route('tablets.index') }}?type=package";
    }

    function goToBack() {
        window.location.href = "{{ route('tablets.index') }}";
    }

    function goToCreateVis() {
        window.location.href = "{{ route('tablets.create') }}?type=visitation";
    }

    function goToCreateRe() {
        window.location.href = "{{ route('tablets.create') }}?type=visitation&&is_returnee=true";
    }

    function goToCreateDel() {
        window.location.href = "{{ route('tablets.create') }}?type=delivery";
    }
</script>

@include('layouts.admin.scripts')
</html>