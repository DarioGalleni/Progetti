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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('people');
            $table->date('date');
            $table->enum('time_slot', ['lunch', 'dinner']);
            $table->time('time');
            $table->text('notes')->nullable();
            $table->integer('tables_needed');
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->string('modification_token')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
