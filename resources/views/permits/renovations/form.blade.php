{{-- $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
$table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
$table->date('date')->nullable();
$table->date('renovation_start_date')->nullable();
$table->foreignId('vendor_id')->nullable()->constrained('vendors')->onDelete('cascade');
$table->enum('status', array_keys(config('enums.application_status')));

$table->string('requirement_checklists')->nullable();

$table->string('refundable_checklists')->nullable();

$table->string('workers_identification_checklists')->nullable();

$table->string('prior_checklists')->nullable();

$table->string('construction_bond_checklists')->nullable();


$table->foreignId('cleared_by_id')->nullable()->constrained('employees')->onDelete('set null');
$table->foreignId('check_by_id')->nullable()->constrained('employees')->onDelete('set null');
$table->foreignId('approved_by_id')->nullable()->constrained('employees')->onDelete('set null');

$table->boolean('cleared_is_signed')->default(false);
$table->boolean('check_is_signed')->default(false);
$table->boolean('approved_is_signed')->default(false);
$table->date('ar_date')->nullable();
$table->string('ar_number')->nullable(); --}}


<div class="col-6 mt-2">
    <x-select name="unit_id" label="Unit" :options="$units" />
</div>


<div class="col-6 mt-2">
    <x-select name="user_id" label="Unit Owner / Tenant" :options="$users" />
</div>

<div class="col-6 mt-2">
    <x-input name="date" label="Date" type="date" />
</div>

<div class="col-6 mt-2">
    <x-input name="renovation_start_date" label="Renovation Date" type="date" />
</div>

<div class="col-6 mt-2">
    <x-select name="vendor_id" label="Vendor" :options="$vendors" />
</div>


<div class="col-6 mt-2">
    <x-input name="ar_date" label="AR DATE" type="date" />
</div>

<div class="col-7 mt-2">
    <x-input name="ar_number" label="AR #" type="text" />
</div>


<div class="col-6 mt-2" id="requirement_checklists">
    <div class="row">
        <div class="col-12">
            <label class="form-label">Requirements</label>
        </div>
        @foreach (App\Models\Renovation::REQUIREMENT_CHECKLISTS as $key => $val )
            <div class="col-12">
                <x-checkbox name="requirement_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>


<div class="col-6 mt-2" id="refundable_checklists">
    <div class="row">
        <div class="col-12">
            <label class="form-label">Refundable Construction Bond</label>
        </div>
        @foreach (App\Models\Renovation::REFUNDABLE_CHECKLISTS as $key => $val )
            <div class="col-12">
                <x-checkbox name="refundable_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>


<div class="col-6 mt-2" id="workers_identification_checklists">
    <div class="row">
        <div class="col-12">
            <label class="form-label">Workers Identification Card Issuance Form</label>
        </div>
        @foreach (App\Models\Renovation::WORKERS_IDENTIFICATION_CHECKLISTS as $key => $val )
            <div class="col-12">
                <x-checkbox name="workers_identification_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>



<div class="col-6 mt-2" id="prior_checklists">
    <div class="row">
        <div class="col-12">
            <label class="form-label">Checklists prior to renovation date.</label>
        </div>
        @foreach (App\Models\Renovation::PRIOR_CHECKLISTS as $key => $val )
            <div class="col-12">
                <x-checkbox name="prior_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>


<div class="col-6 mt-2" id="construction_bond_checklists">
    <div class="row">
        <div class="col-12">
            <label class="form-label">REFUND OF THE CONSTRUCTION BOND</label>
        </div>
        @foreach (App\Models\Renovation::CONSTRUCTION_BOND_CHECKLISTS as $key => $val )
            <div class="col-12">
                <x-checkbox name="construction_bond_checklists[]" value="{{ $key }}" label="{{ $val }}" :is-checked="false"/>
            </div>
        @endforeach
    </div>
</div>

<div class="col-6 mt-2">
    <x-select name="cleared_by_id" label="Cleared By" :options="$administrative_officers" />
</div>

<div class="col-6 mt-2">
    <x-select name="check_by_id" label="Checked By" :options="$property_engineers" />
</div>

<div class="col-6 mt-2">
    <x-select name="approved_by_id" label="Approved By" :options="$executive_ao_complex_managers" />
</div>
