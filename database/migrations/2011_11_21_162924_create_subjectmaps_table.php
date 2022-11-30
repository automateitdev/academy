<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjectmaps', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('institute_id');
            $table->bigInteger('class_id');
            $table->bigInteger('group_id');
            $table->bigInteger('subject_id');
            $table->bigInteger('type');
            $table->bigInteger('serial');
            $table->bigInteger('merge')->nullable();
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
        Schema::dropIfExists('subjectmaps');
    }
}
