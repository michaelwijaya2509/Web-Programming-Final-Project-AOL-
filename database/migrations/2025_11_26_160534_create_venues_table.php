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
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('type', ['badminton', 'tenis', 'padel','pickleball'])->default('badminton');
            $table->enum('space', ['indoor', 'outdoor'])->default('indoor');
            $table->string('location', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->decimal('price_per_hour', 10, 2)->default(0);
            $table->string('venue_image')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
};
