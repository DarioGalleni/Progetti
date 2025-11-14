<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ombrellone_id')->constrained('ombrelloni')->onDelete('cascade');
            $table->string('nome');
            $table->string('cognome');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->decimal('costo_totale', 8, 2)->nullable();
            $table->decimal('acconto', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prenotazioni');
    }
};