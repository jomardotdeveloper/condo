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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('unit_number')->unique();
            $table->foreignId('cluster_id')->constrained()->onDelete('cascade');
            $table->string('unit_tower')->nullable();
            $table->string('unit_floor');
            $table->string('unit_room');
            $table->enum('unit_type', array_keys(config('enums.unit_types')));
            $table->string('floor_area')->nullable();
            // $table->string('unit_association_fee');
            // $table->string('unit_parking_fee');
            $table->enum('status', array_keys(config('enums.unit_status')));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
