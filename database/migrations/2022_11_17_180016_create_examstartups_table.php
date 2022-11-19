<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamstartupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examstartups', function (Blueprint $table) {
            $table->increments('id');
            $table->unique(array('institute_id','class_id','exam_id','merit_id'));
            $table->string('institute_id');
            $table->bigInteger('class_id');
            $table->bigInteger('exam_id');
            $table->bigInteger('merit_id');
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
        Schema::dropIfExists('examstartups');
    }
}
