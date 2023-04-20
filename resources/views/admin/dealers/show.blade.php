@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('dealers.index')),
        array('name' => 'View', 'url' => route('dealers.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="View Vendor" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    @if ($dealer->afs_src)
    <a href="{{ $dealer->afs_src }}" target="_blank" class="btn btn-primary">View AFS</a>
    @endif

    @if ($dealer->mayors_permit_src)
    <a href="{{ $dealer->mayors_permit_src }}" target="_blank" class="btn btn-primary">View Mayors Permit</a>
    @endif

    @if ($dealer->dti_src)
    <a href="{{ $dealer->dti_src }}" target="_blank" class="btn btn-primary">View DTI/SEC Certificate</a>
    @endif

    @if ($dealer->bir_src)
    <a href="{{ $dealer->bir_src }}" target="_blank" class="btn btn-primary">View BIR Certificate</a>
    @endif

    @if ($dealer->company_profile_src)
    <a href="{{ $dealer->company_profile_src }}" target="_blank" class="btn btn-primary">View Company Profile</a>
    @endif

    @if($dealer->status == 2 && $dealer->user_id == null)
    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#user-create-modal">
        Create User Account
    </button>
    @endif

    <x-modal id="user-create-modal" title="Create User" footer="User">
        <form action="{{ route('dealers.store-user') }}" class="row" method="POST">
            @csrf
            <input type="hidden" name="dealer_id" value="{{ $dealer->id }}"/>
    
            <div class="col-12">
                <x-input name="email" label="Email" type="email" :default-value="$dealer->email" :is-required="true"/>
            </div>
    
            <div class="col-12">
                <x-input name="password" label="Password" type="password" :is-required="true"/>
            </div>
    
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    </x-modal>

    <div class="card card-bordered card-preview mt-2">
        <div class="card-inner">
            <div class="tab-content">
                <h6 class="title overline-title text-base">Vendor Details</h6>
                <div class="tab-pane active" id="personal-info">
                    <div class="nk-block">
                        <div class="profile-ud-list">
                            <x-show-item label="Organization Number" value="{{ $dealer->organization_number }}"/>
                            <x-show-item label="Registration Date" value="{{ $dealer->created_at }}"/>
                            <x-show-item label="Form of organization" value="{{ $dealer->form_of_organization_name }}"/>
                            <x-show-item label="Organization Name" value="{{ $dealer->organization_name }}"/>
                            <x-show-item label="Organization Type" value="{{ $dealer->type_name_str }}"/>
                            <x-show-item label="Business Category" value="{{ $dealer->category_name_str }}"/>
                            <x-show-item label="Capitalization" value="{{ $dealer->capitalization }}"/>
                            <x-show-item label="Business Tax Identification Number" value="{{ $dealer->business_tax_identification_number }}"/>
                            <x-show-item label="DTI/SEC Certificate Number" value="{{ $dealer->dti_certificate_number }}"/>
                            <x-show-item label="DTI/SEC Registration Date" value="{{ $dealer->dti_registration_date }}"/>
                            <x-show-item label="Acronym" value="{{ $dealer->acronym }}"/>
                            <x-show-item label="Former Name" value="{{ $dealer->former_name }}"/>

                            <x-show-item label="Number of employees" value="{{ $dealer->number_of_employees }}"/>
                            <x-show-item label="Previous Year's Revenue(PHP)" value="{{ $dealer->prev_year_revenue }}"/>
                            <x-show-item label="Website Address" value="{{ $dealer->website_address }}"/>
                            <x-show-item label="Description" value="{{ $dealer->description }}"/>
                            <x-show-item label="Business Address" value="{{ $dealer->address }}"/>
                            <x-show-item label="Company Representative Full Name" value="{{ $dealer->full_name }}"/>
                            <x-show-item label="Company Representative Email" value="{{ $dealer->email }}"/>
                            <x-show-item label="Company Representative Mobile Number" value="{{ $dealer->mobile_number }}"/>
                            <x-show-item label="Bank name" value="{{ $dealer->bank_name }}"/>
                            <x-show-item label="Bank account number" value="{{ $dealer->bank_account_number }}"/>
                            <x-show-item label="Bank account name" value="{{ $dealer->bank_name }}"/>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection