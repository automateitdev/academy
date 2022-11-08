<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institute_id');
            $table->bigInteger('subcat_id');
            $table->string('id_no')->nullable();
            $table->bigInteger('nid')->uniqid;
            $table->string('name');
            $table->string('f_name');
            $table->string('m_name');
            $table->string('edu');
            $table->string('sex');
            $table->string('religion');
            $table->string('birth_date');
            $table->string('designation');
            $table->string('blood')->nullable();
            $table->string('address')->nullable();
            $table->string('mobile');
            $table->string('email');
            $table->date('join_date')->nullable();
            $table->string('note')->nullable();
            $table->mediumText('photo')->nullable();
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
        Schema::dropIfExists('administrations');
    }
}
