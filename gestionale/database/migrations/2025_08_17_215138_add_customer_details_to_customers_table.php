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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->date('arrival_date');
            $table->date('departure_date');
            $table->enum('treatment', ['BB', 'HB', 'FB']);
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->unsignedInteger('number_of_people');
            $table->decimal('total_stay_cost', 8, 2);
            $table->decimal('down_payment', 8, 2)->nullable();
            $table->enum('additional_expenses', ['spiaggia', 'bici', 'pasti', 'bevande', 'late_checkout'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name',
                'arrival_date',
                'departure_date',
                'treatment',
                'phone',
                'email',
                'number_of_people',
                'total_stay_cost',
                'down_payment',
                'additional_expenses'
            ]);
        });
    }
};