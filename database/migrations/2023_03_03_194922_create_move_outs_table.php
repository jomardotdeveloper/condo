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
        Schema::create('move_outs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_owner')->default(false);
            $table->date('move_out_date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->longText('item_quantities')->nullable();
            $table->longText('item_names')->nullable();
            $table->longText('item_descriptions')->nullable();
            $table->longText('item_remarks')->nullable();
            $table->string('charges_checklists')->nullable();
            $table->string('others')->nullable();
            $table->string('or_ar_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('additional_instruction_by_accounting')->nullable();
            $table->string('collection_of_assessments')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('cleared_by')->nullable();
            $table->string('verified_by')->nullable();
            $table->string('noted_by')->nullable();
            $table->string('additional_instruction')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', array_keys(config('enums.application_status')));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('move_outs');
    }
};
