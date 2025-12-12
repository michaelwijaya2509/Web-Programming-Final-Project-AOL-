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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')->nullable(false);

            $table->foreignId('venue_id')
                ->constrained()
                ->onDelete('cascade')->nullable(false);
            
            $table->foreignId('court_id')
                ->constrained()
                ->onDelete('cascade')->nullable(false);

            $table->date('booking_date')->nullable(false);      // tanggal main
            $table->time('start_time')->nullable(false);        // jam mulai
            $table->time('end_time')->nullable(false);          // jam selesai

            // total harga (duration * price_per_hour)
            $table->decimal('total_price', 10, 2)->nullable(false);

            // status booking
            $table->enum('status', [
                'pending',    // baru booking, menunggu approval/pembayaran
                'approved',   // disetujui admin (opsional)
                'rejected',   // ditolak admin
                'paid',       // sudah bayar
                'completed',  // sudah selesai main
                'cancelled',  // dibatalkan
            ])->default('pending');

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
