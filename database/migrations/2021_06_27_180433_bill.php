<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idStudent')->unsigned();
            $table->integer('idTypepay');
            $table->integer('idAdmin')->unsigned();
            $table->date('dateTime');
            $table->double('money');
            $table->text('note');
            $table->foreign('idStudent')->references('id')->on('student');
            $table->foreign('idAdmin')->references('id')->on('admin');
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
        Schema::drop('bill');
    }
}
