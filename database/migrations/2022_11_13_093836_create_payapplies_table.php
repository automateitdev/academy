<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayappliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payapplies', function (Blueprint $table) {
            $table->increments('id');
            $table->unique(array('student_id', 'class_id', 'feehead_id', 'feesubhead_id'));
            $table->string('institute_id');
            $table->bigInteger('student_id');
            $table->bigInteger('class_id');
            $table->bigInteger('feehead_id');
            $table->bigInteger('feesubhead_id');
            $table->double('payable');
            $table->double('fine')->nullable();
            $table->bigInteger('waiver_id')->nullable();
            $table->double('waiver_amount')->nullable();
            $table->string('invoice')->nullable();
            $table->bigInteger('payment_state')->default(0);
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
        Schema::dropIfExists('payapplies');
    }
}
