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
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit_towers')->nullable();
            $table->integer('reading_day');
            $table->integer('due_date');
            $table->string('monthly_due_rate')->default("0");
            $table->string('parking_rate')->default("0");
            $table->string('electricity_rate')->default("0");
            $table->string('water_rate')->default("0");
            $table->string('penalty_rate')->default("0");
            $table->string('recollection_fee')->default("0");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clusters');
    }
};
