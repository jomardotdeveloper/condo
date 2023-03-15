@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Inventory', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('vendors.index')),
        array('name' => 'Edit', 'url' => route('vendors.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Vendor" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('vendors.update', ['vendor' => $vendor]) }}" class="row" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <x-input name="company_name" label="Company Name" type="text" :is-required="true" :default-value="$vendor->company_name"/>
                </div>
                <div class="col-6">
                    <x-input name="company_address" label="Company Address" type="text" :is-required="true" :default-value="$vendor->company_address"/>
                </div>
                <div class="col-6">
                    <x-input name="contact_no" label="Contact #" type="text" :is-required="true" :default-value="$vendor->contact_no"/>
                </div>
                <div class="col-6">
                    <x-input name="email" label="Email" type="email" :default-value="$vendor->email"/>
                </div>
                <div class="col-6">
                    <x-input name="service" label="Service" type="text" :default-value="$vendor->service"/>
                </div>
                <div class="col-6">
                    <x-input name="industry" label="Industry" type="text" :default-value="$vendor->industry"/>
                </div>
                <div class="col-6">
                    <x-input name="contact_person" label="Contact Person" type="text" :default-value="$vendor->contact_person"/>
                </div>
                <div class="col-6 mt-4">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_contractor" name="is_contractor" {{ $vendor->is_contractor ? "checked" : "" }}>
                        <label class="custom-control-label" for="is_contractor">Is Contractor</label>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_supplier" name="is_supplier" {{ $vendor->is_supplier ? "checked" : "" }}>
                        <label class="custom-control-label" for="is_supplier">Is Supplier</label>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection