<?php

use App\Models\Parking;
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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('cluster_id')->constrained()->onDelete('cascade');
            $table->string('unit_tower')->nullable();
            $table->string('parking_floor_area')->nullable();
            $table->string('parking_level')->nullable();
            $table->string('slot_number');
            $table->string('plate_number')->nullable();
            $table->enum('status', array_keys(Parking::STATUS));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
