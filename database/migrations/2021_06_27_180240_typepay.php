<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Typepay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('typepay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('typeofpay', 50);
            $table->float('discount');
            $table->tinyInteger('begin');
            $table->tinyInteger('end');
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
        Schema::drop('typepay');
    }
}
