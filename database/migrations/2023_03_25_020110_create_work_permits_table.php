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
        Schema::create('work_permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('name_of_contractor')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_owner')->default(false);
            $table->string('scope_of_work_checklists')->nullable();
            $table->string('service_provider_checklists')->nullable();
            $table->string('others')->nullable();
            $table->string('name_of_workers')->nullable();
            $table->string('scope_of_works')->nullable();
            $table->foreignId('debit_id')->constrained('debits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_permits');
    }
};
