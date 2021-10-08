<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tuition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tuition', function (Blueprint $table) {
            $table->integer('idMajor')->unsigned();
            $table->integer('idCourse')->unsigned();
            $table->double('tuitionNorm');
            $table->primary(['idCourse','idMajor']);
            $table->foreign('idMajor')->references('id')->on('major');
            $table->foreign('idCourse')->references('id')->on('course');
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
        //
        Schema::drop('tuition');
    }
}
