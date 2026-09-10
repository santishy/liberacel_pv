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
        Schema::table('raffle_numbers', function (Blueprint $table) {
            $table->unique(['saleable_type', 'saleable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raffle_numbers', function (Blueprint $table) {
            $table->dropUnique(['saleable_type', 'saleable_id']);
        });
    }
};
