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
        Schema::create('pre_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('room_id');
            $table->string('name');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->integer('adult');
            $table->integer('children');
            $table->string('email');
            $table->string('number');
            $table->enum('status', ['Booked', 'Waiting', 'Cancelled', 'Arrived', 'Checked-In'])->default('Waiting');
            $table->integer('stayed');
            $table->integer('total_price');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_bookings');
    }
};