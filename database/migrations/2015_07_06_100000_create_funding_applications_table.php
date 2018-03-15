<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_applications', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->integer('funder_id')->unsigned();
            $table->string('scheme');
            $table->float('amount')->nullable();
            $table->string('currency')->nullable();
            $table->date('submission_date')->nullable();
            $table->text('summary');
            $table->string('stage');
            $table->boolean('success');
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('funder_id')->references('id')->on('funders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funding_applications');
    }
}
