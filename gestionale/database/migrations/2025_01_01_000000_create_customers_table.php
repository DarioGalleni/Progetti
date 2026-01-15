<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->integer('room');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->enum('treatment', ['BB', 'HB']);
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedInteger('number_of_people')->nullable();
            $table->decimal('total_stay_cost', 8, 2);
            $table->decimal('down_payment', 8, 2)->nullable();
            $table->text('additional_notes')->nullable();
            $table->boolean('is_booking')->default(false);
            $table->boolean('is_cash_payment')->default(false);
            $table->boolean('is_group')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
