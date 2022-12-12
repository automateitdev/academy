<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examconfigs', function (Blueprint $table) {
            $table->id();
            $table->unique(array('institute_id', 'class_id', 'group_id','subjectmap_id', 'examstartups_id','examcode_id'), 'exam_mark_combination');
            $table->string('institute_id');
            $table->bigInteger('class_id');
            $table->bigInteger('group_id');
            $table->bigInteger('subjectmap_id');
            $table->bigInteger('examstartups_id');
            $table->bigInteger('examcode_id');
            $table->integer('total_marks');
            $table->integer('pass_mark');
            $table->integer('acceptance');
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
        Schema::dropIfExists('examconfigs');
    }
}
