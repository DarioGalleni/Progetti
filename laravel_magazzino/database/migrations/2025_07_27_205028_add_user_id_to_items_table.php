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
        // Modificato il riferimento alla tabella da 'items_models' a 'items'
        Schema::table('items', function (Blueprint $table) { // Modificato da 'items_models' a 'items'
            // Aggiunge la colonna user_id come chiave esterna
            $table->foreignId('user_id')
                  ->nullable() // Reso nullabile per la clausola onDelete('set null')
                  ->constrained()
                  ->onDelete('set null'); // Se l'utente viene eliminato, user_id nell'articolo diventa null
        });
    }

    /**
     * Reverse the migrations.
     * Annulla le migrazioni.
     */
    public function down(): void
    {
        // Modificato il riferimento alla tabella da 'items_models' a 'items'
        Schema::table('items', function (Blueprint $table) { // Modificato da 'items_models' a 'items'
            $table->dropConstrainedForeignId('user_id'); // Rimuove la chiave esterna
            $table->dropColumn('user_id'); // Rimuove la colonna user_id
        });
    }
};
