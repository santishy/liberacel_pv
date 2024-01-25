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
        Schema::table('product_bonuses', function (Blueprint $table) {
            $table->decimal("commission_amount", 8, 2)->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_bonuses', function (Blueprint $table) {
            $table->dropColumn("commission_amount");
        });
    }
};
