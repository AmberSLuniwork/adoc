<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_fundings', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('funding_application_id')->unsigned();
            $table->float('amount');
            $table->string('currency');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('funding_application_id')->references('id')->on('funding_applications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_fundings');
    }
}
