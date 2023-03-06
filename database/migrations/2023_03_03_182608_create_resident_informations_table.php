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
            $table->string('marital_status')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('parking_slot')->nullable();
            $table->string('gender')->nullable();
            $table->string('emergency_name')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('emergency_address')->nullable();
            $table->string('authorized_unit_occupant_lines')->nullable();
            $table->string('househelper_driver_lines')->nullable();
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
