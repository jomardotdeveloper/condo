<?php

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
        Schema::create('resident_informations', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->string('mobile_number')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('occupation')->nullable();
            $table->string('citizenship')->nullable();
            $table->enum('marital_status', config('enums.marital_status'))->nullable();
            $table->string('telephone_number')->nullable();
            $table->enum('gender', config('enums.gender'))->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('authorized_unit_occupant_names')->nullable();
            $table->string('authorized_unit_occupant_relations')->nullable();
            $table->string('authorized_unit_occupant_ages')->nullable();
            $table->string('authorized_unit_occupant_remarks')->nullable();
            $table->string('househelper_driver_names')->nullable();
            $table->string('househelper_driver_ages')->nullable();
            $table->string('househelper_driver_remarks')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('noted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_informations');
    }
};
