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
        Schema::create('renovations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
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
            $table->string('ar_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renovations');
    }
};
