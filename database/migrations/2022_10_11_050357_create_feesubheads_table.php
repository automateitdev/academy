<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesubheadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feesubheads', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('fee_head_id')->onUpdate('cascade')->onDelete('cascade');
            $table->string('institute_id');
            $table->string('subhead_name');
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
        Schema::dropIfExists('feesubheads');
    }
}
