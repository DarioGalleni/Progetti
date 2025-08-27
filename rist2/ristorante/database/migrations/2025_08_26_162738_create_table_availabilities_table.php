<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('table_availability', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time_slot');
            $table->integer('available_tables')->default(20);
            $table->timestamps();
            

            $table->unique(['date', 'time_slot']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('table_availability');
    }
};