<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddElectronicMoneyDiscountToFastSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fast_sales', function (Blueprint $table) {
            $table->float('electronic_money_discount',8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fast_sales', function (Blueprint $table) {
            $table->dropColumn('electronic_money_discount');
        });
    }
}
