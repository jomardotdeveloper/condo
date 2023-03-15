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
        Schema::create('debits', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->float('move_in_fee')->default(0);
            $table->float('move_out_fee')->default(0);
            $table->float('parking_fee')->default(0);
            $table->float('monthly_due_fee')->default(0);
            $table->float('electric_fee')->default(0);
            $table->float('water_fee')->default(0);
            $table->float('penalty_fee')->default(0);
            $table->float('other_fee')->default(0);
            $table->text('description')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units')->onDelete('set null');
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('set null');
            $table->foreignId('move_out_id')->nullable()->constrained('move_outs')->onDelete('set null');
            $table->enum('type', array_keys(config('enums.debit_types')));
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debits');
    }
};
