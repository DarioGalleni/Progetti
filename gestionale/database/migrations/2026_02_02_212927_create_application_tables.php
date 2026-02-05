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
        // Create customers table
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('room_number');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->string('treatment')->nullable();
            $table->integer('pax')->default(1);
            $table->integer('under_12_pax')->nullable()->default(0);
            $table->decimal('total_price', 10, 2)->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();

            // Group fields
            $table->string('group_id')->nullable()->index();
            $table->string('group_name')->nullable();

            $table->timestamps();
        });

        // Create expenses table
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->decimal('amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('customers');
    }
};
