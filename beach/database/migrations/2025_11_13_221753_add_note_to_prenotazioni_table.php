<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->text('note')->nullable()->after('acconto');
        });
    }

    public function down(): void
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
};