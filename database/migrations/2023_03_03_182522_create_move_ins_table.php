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
        Schema::create('move_ins', function (Blueprint $table) {
            $table->id();
            $table->date('move_in_date');
            $table->integer('number_of_person')->nullable();
            $table->string('unit_owner_checklists')->nullable();
            $table->string('unit_tenant_checklists')->nullable();
            $table->string('tenant_bond_ar')->nullable();
            $table->string('utility_bond_ar')->nullable();
            $table->string('charges_checklists')->nullable();
            $table->string('charges_remarks')->nullable();
            $table->string('signature_checklists')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('cleared_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('noted_by')->nullable();
            $table->string('additional_instruction')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_ins');
    }
};
