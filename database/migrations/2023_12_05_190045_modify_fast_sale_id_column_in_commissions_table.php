<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFastSaleIdColumnInCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->decimal("amount", 8, 2)->default(0)->change();
            $table->dropForeign(["fast_sale_id"]);
            $table->dropColumn("fast_sale_id");
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs("commissionable");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropMorphs("commissionable");
            $table->float('amount')->default(0)->change();
            $table->foreignId('fast_sale_id')
                ->constrained()
                ->cascadeOnDelete();
        });
    }
}
