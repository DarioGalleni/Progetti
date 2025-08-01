<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Esegue le migrazioni.
     */
    public function up(): void
    {
        // Renamed 'items_models' to 'items'
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('item_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
        * Annulla le migrazioni.
        */
    public function down(): void
    {
        // Renamed 'items_models' to 'items'
        Schema::dropIfExists('items');
    }
};