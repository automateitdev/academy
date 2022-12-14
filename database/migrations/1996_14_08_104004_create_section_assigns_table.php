<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class CreateSectionAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_assigns', function (Blueprint $table) {
            $table->increments('id');
            // $table->unique(array('institute_id','class_id','section_id','shift_id'),'section_combination');
            $table->string('institute_id');
            $table->bigInteger('class_id');
            $table->bigInteger('section_id');
            $table->bigInteger('shift_id');
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
        Schema::dropIfExists('section_assigns');
    }
}
