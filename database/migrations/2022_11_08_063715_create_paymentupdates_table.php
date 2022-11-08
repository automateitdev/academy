<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentupdatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentupdates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('institute_id');
            $table->string('session_token');
            $table->string('ststus');
            $table->string('msg');
            $table->string('transaction_id');
            $table->string('transaction_date');
            $table->string('invoice_no');
            $table->string('invoice_date');
            $table->string('br_code');
            $table->string('applicant_name');
            $table->string('applicant_no');
            $table->string('total_amount');
            $table->string('pay_status');
            $table->string('pay_mode');
            $table->string('pay_amount');
            $table->string('vat');
            $table->string('comission');
            $table->string('scroll_no');
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
        Schema::dropIfExists('paymentupdates');
    }
}
