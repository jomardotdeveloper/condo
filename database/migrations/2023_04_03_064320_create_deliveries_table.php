<?php

use App\Models\Delivery;
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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->enum('type', array_keys(Delivery::TYPE));
            $table->string('receiver_name')->nullable();
            $table->string('from')->nullable();
            $table->string('number_of_items')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('notes')->nullable();
            $table->dateTime('expected_arrival_date')->nullable();
            $table->string('plate_number')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
