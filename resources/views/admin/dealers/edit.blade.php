@extends("layouts.admin.master")
@section("content")
<div class="nk-block nk-block-lg">
    {{-- BREADCRUMB --}}
    <x-breadcrumb :items="[
        array('name' => 'Purchasing', 'url' => 'javascript:void(0);'),
        array('name' => 'Vendors', 'url' => route('dealers.index')),
        array('name' => 'Edit', 'url' => route('dealers.create')),
    ]"/>
    

    {{-- TITLE --}}
    <x-datatable-head title="Edit Vendor" />

    {{-- ALERTS --}}
    @include('admin.includes.alerts')

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ route('dealers.update', ['dealer' => $dealer]) }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="col-6 mt-2">
                    <x-input name="organization_number" label="Organization Number" type="text" :default-value="$dealer->organization_number"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="status" label="Status" :options="$status" :is-required="true" :default-value="$dealer->status"/>
                </div>

                <div class="col-6 mt-2">
                    <x-select name="form_of_organization" label="Form of Organization" :options="$forms" :is-required="true" :default-value="$dealer->form_of_organization"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="organization_name" label="Organization Name" type="text" :default-value="$dealer->organization_name"/>
                </div>


                <div class="col-6 mt-2" >
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Organization Type</label>
                        </div>
                        @foreach ($type_checklists as $key => $val )
                            <div class="col-12">
                                <x-checkbox name="type_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $dealer->type_checklists_arr)"/>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-6 mt-2" >
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Business Category</label>
                        </div>
                        @foreach ($category_checklists as $key => $val )
                            <div class="col-12">
                                <x-checkbox name="category_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="in_array(strval($key), $dealer->category_checklists_arr)"/>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="col-6 mt-2">
                    <x-input name="capitalization" label="Capitalization" type="text" :default-value="$dealer->capitalization"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="business_tax_identification_number" label="Business Tax Identification Number" type="text" :default-value="$dealer->business_tax_identification_number"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="dti_certificate_number" label="DTI/SEC Certificate Number" type="text" :default-value="$dealer->dti_certificate_number"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="dti_registration_date" label="DTI/SEC Registration Date" type="date" :default-value="$dealer->dti_registration_date"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="acronym" label="Acronym" type="text" :default-value="$dealer->acronym"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="former_name" label="Former Name" type="text" :default-value="$dealer->former_name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="number_of_employees" label="Number of employees" type="text" :default-value="$dealer->number_of_employees"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="prev_year_revenue" label="Previous Year's Revenue (PHP)" type="text" :default-value="$dealer->prev_year_revenue"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="website_address" label="Website Address" type="text" :default-value="$dealer->website_address"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="description" label="Description of the organization" type="text" :default-value="$dealer->description"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="address" label="Business Address" type="text" :default-value="$dealer->address"/>
                </div>


                <div class="col-6 mt-2">
                    <x-input name="first_name" label="First Name" type="text" :default-value="$dealer->first_name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="last_name" label="Last Name" type="text" :default-value="$dealer->last_name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="email" label="Email" type="text" :default-value="$dealer->email"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="mobile_number" label="Mobile Number" type="text" :default-value="$dealer->mobile_number"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="bank_name" label="Bank Name" type="text" :default-value="$dealer->bank_name"/>
                </div>

                <div class="col-6 mt-2">
                    <x-input name="bank_account_number" label="Bank Account Number" type="text" :default-value="$dealer->bank_account_number"/>
                </div>


                <div class="col-6 mt-2">
                    <x-input name="bank_account_name" label="Bank Account Name" type="text" :default-value="$dealer->bank_account_name"/>
                </div>


                <div class="col-6 mt-2">
                    <x-input name="mayors_permit_src" label="Update Mayors Permit" type="file" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="dti_src" label="Update DTI/SEC Certificate" type="file" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="bir_src" label="Update BIR Certificate" type="file" />
                </div>


                <div class="col-6 mt-2">
                    <x-input name="afs_src" label="Update AFS" type="file" />
                </div>

                <div class="col-6 mt-2">
                    <x-input name="company_profile_src" label="Update Company Profile" type="file" />
                </div>




                <div class="col-12 mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>

@endsection