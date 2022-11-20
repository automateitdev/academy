<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institute_id');
            $table->string('std_id')->unique();
            $table->integer('academic_year_id');
            $table->integer('session_id');
            $table->integer('section_id');
            $table->integer('std_category_id');
            $table->integer('group_id');
            $table->bigInteger('roll');
            $table->string('name');
            $table->bigInteger('gender_id')->unsigned();
            $table->bigInteger('religion_id')->unsigned();
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('mobile_no');
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
        Schema::dropIfExists('students');
    }
}
