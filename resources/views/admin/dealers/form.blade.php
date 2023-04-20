
<div class="col-6 mt-2">
    <x-input name="organization_number" label="Organization Number" type="text" />
</div>

<div class="col-6 mt-2">
    <x-select name="form_of_organization" label="Form of Organization" :options="$forms" :is-required="true"/>
</div>

<div class="col-6 mt-2">
    <x-input name="organization_name" label="Organization Name" type="text" />
</div>


<div class="col-6 mt-2" >
    <div class="row">
        <div class="col-12">
            <label class="form-label">Organization Type</label>
        </div>
        @foreach ($type_checklists as $key => $val )
            <div class="col-12">
                <x-checkbox name="type_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
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
                <x-checkbox name="category_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>


<div class="col-6 mt-2">
    <x-input name="capitalization" label="Capitalization" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="business_tax_identification_number" label="Business Tax Identification Number" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="dti_certificate_number" label="DTI/SEC Certificate Number" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="dti_registration_date" label="DTI/SEC Registration Date" type="date" />
</div>

<div class="col-6 mt-2">
    <x-input name="acronym" label="Acronym" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="former_name" label="Former Name" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="number_of_employees" label="Number of employees" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="prev_year_revenue" label="Previous Year's Revenue (PHP)" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="website_address" label="Website Address" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="description" label="Description of the organization" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="address" label="Business Address" type="text" />
</div>


<div class="col-6 mt-2">
    <x-input name="first_name" label="First Name" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="last_name" label="Last Name" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="email" label="Email" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="mobile_number" label="Mobile Number" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="bank_name" label="Bank Name" type="text" />
</div>

<div class="col-6 mt-2">
    <x-input name="bank_account_number" label="Bank Account Number" type="text" />
</div>


<div class="col-6 mt-2">
    <x-input name="bank_account_name" label="Bank Account Name" type="text" />
</div>


<div class="col-6 mt-2">
    <x-input name="mayors_permit_src" label="Mayors Permit" type="file" />
</div>

<div class="col-6 mt-2">
    <x-input name="dti_src" label="DTI/SEC Certificate" type="file" />
</div>

<div class="col-6 mt-2">
    <x-input name="bir_src" label="BIR Certificate" type="file" />
</div>


<div class="col-6 mt-2">
    <x-input name="afs_src" label="AFS" type="file" />
</div>

<div class="col-6 mt-2">
    <x-input name="company_profile_src" label="Company Profile" type="file" />
</div>



