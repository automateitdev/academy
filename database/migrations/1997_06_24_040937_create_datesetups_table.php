<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatesetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datesetups', function (Blueprint $table) {
            $table->increments('id');
            $table->unique(array('institute_id', 'academic_year_id', 'class_id', 'feehead_id', 'feesubhead_id'), 'feehead_combination');
            $table->string('institute_id');
            $table->bigInteger('academic_year_id');
            $table->bigInteger('class_id');
            $table->bigInteger('feehead_id');
            $table->bigInteger('feesubhead_id');
            $table->date('payable_date');
            $table->date('fineactive_date');
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
        Schema::dropIfExists('datesetups');
    }
}
