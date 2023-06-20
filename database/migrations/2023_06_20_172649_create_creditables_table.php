<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->morphs('creditable');
            $table->timestamps();
            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditables');
    }
}
