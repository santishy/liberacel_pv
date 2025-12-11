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
        Schema::create('raffle_numbers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raffle_id')->constrained('raffles')->onDelete('cascade');
            $table->string('code', 4);
            $table->unsignedSmallInteger('number');
            $table->enum('status', ['available', 'assigned'])->default('available');
            $table->nullableMorphs('saleable');
            $table->timestamps();
            $table->unique(['raffle_id', 'number']);
            $table->index(['raffle_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffle_numbers');
    }
};
