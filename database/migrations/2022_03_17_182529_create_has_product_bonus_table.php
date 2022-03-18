<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHasProductBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('has_product_bonus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fast_sale_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_bonus_id')->constrained()->cascadeOnDelete();
            $table->integer('qty')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('has_product_bonus');
    }
}
