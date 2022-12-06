<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentSubjectMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_subject_maps', function (Blueprint $table) {
            $table->increments('id');
            $table->unique(array('institute_id', 'student_id', 'subjectmap_id'), 'student_subject_combination');
            $table->string('institute_id');
            $table->bigInteger('student_id');
            $table->bigInteger('class_id');
            $table->bigInteger('group_id');
            $table->bigInteger('subjectmap_id');
            $table->bigInteger('subject_type_id');
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
        Schema::dropIfExists('student_subject_maps');
    }
}
