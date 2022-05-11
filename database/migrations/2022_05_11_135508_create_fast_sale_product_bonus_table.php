<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFastSaleProductBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fast_sale_product_bonus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_bonus_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('fast_sale_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
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
        Schema::dropIfExists('fast_sale_product_bonus');
    }
}
