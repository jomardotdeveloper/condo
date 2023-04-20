<?php

use App\Models\Dealer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dealers', function (Blueprint $table) {
            $table->id();
            $table->string('organization_number')->nullable();
            $table->enum('form_of_organization', array_keys(Dealer::FORM_OF_ORGANIZATION))->nullable();
            $table->string('organization_name')->nullable();
            $table->string('type_checklists')->nullable();
            $table->string('category_checklists')->nullable();
            $table->string('capitalization')->nullable();
            $table->string('business_tax_identification_number')->nullable();
            $table->string('dti_certificate_number')->nullable();
            $table->date('dti_registration_date')->nullable();
            $table->string('acronym')->nullable();
            $table->string('former_name')->nullable();
            $table->string('number_of_employees')->nullable();
            $table->string('prev_year_revenue')->nullable();
            $table->string('website_address')->nullable();
            $table->string('description')->nullable();
            $table->string('address')->nullable();
            $table->string('first_name')->nullable();
            $table->string('email')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('mayors_permit_src')->nullable();
            $table->string('dti_src')->nullable();
            $table->string('bir_src')->nullable();
            $table->string('afs_src')->nullable();
            $table->string('company_profile_src')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', array_keys(Dealer::STATUS))->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealers');
    }
};
