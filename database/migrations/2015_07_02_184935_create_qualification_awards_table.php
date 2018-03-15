<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualificationAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_awards', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('qualification_id')->unsigned();
            $table->integer('year');
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('qualification_id')->references('id')->on('qualifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('qualification_awards');
    }
}
