<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreditColumnsToFastSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fast_sales', function (Blueprint $table) {
            $table->foreignId('client_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');

            $table->boolean('is_credit')->default(false);
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
            $table->dropColumn(['client_id', 'is_credit']);
        });
    }
}
