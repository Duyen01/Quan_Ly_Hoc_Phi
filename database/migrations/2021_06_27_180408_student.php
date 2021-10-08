<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Student extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->boolean('gender');
            $table->string('email', 50)->unique();
            $table->string('phone', 20)->unique();
            $table->string('password', 150);
            $table->string('address', 150);
            $table->date('dob');
            // $table->tinyInteger('status');
            $table->integer('idGrade')->unsigned();
            $table->integer('idScholarship')->unsigned();
            $table->integer('idTypePay')->unsigned();
            $table->foreign('idGrade')->references('id')->on('grade');
            $table->foreign('idScholarship')->references('id')->on('scholarship');
            $table->foreign('idTypePay')->references('id')->on('typepay');
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
        Schema::drop('student');
    }
}
