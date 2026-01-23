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
        Schema::table('journeys', function (Blueprint $table) {
            $table->json('includes')->nullable()->after('image');
            $table->json('excludes')->nullable()->after('includes');
            $table->json('itinerary')->nullable()->after('excludes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journeys', function (Blueprint $table) {
            $table->dropColumn(['includes', 'excludes', 'itinerary']);
        });
    }
};
