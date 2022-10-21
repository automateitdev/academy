<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeMapingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_mapings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institute_id');
            $table->bigInteger('feehead_id')->unique();
            $table->bigInteger('feesubhead_id');
            $table->bigInteger('ledger_id');
            $table->bigInteger('fund_id');
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
        Schema::dropIfExists('fee_mapings');
    }
}
