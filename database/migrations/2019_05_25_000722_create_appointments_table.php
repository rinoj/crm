<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {

            $table->increments('id');
            $table->string('title');
            $table->integer('user_id');
            $table->integer('lead_id');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::dropIfExists('appointments');
    }
}
