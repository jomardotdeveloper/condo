@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Inventory', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('vendors.index')),
        array('name' => 'View', 'url' => route('units.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Vendor" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Vendor Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Company Name" value="{{ $vendor->company_name }}"/>
                            <x-show-item label="Company Address" value="{{ $vendor->company_address }}"/>
                            <x-show-item label="Contact #" value="{{ $vendor->contact_no }}"/>
                            <x-show-item label="Email" value="{{ $vendor->email }}"/>
                            <x-show-item label="Contact Person" value="{{ $vendor->contact_person }}"/>
                            <x-show-item label="Contractor" value="{{ $vendor->is_contractor }}"/>
                            <x-show-item label="Supplier" value="{{ $vendor->is_supplier }}"/>
                            <x-show-item label="Industry" value="{{ $vendor->industry }}"/>
                            <x-show-item label="Service" value="{{ $vendor->service }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($vendor->is_supplier)
    <div class="card">
        <div class="card-inner">
            <h6 class="title overline-title text-base">Items</h6>
            <table class="datatable-init table">
                <thead>
                    <tr>
                        <th>Item name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendor->items as $item)
                        <tr>
                            <td>{{ $item }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

@endsection
