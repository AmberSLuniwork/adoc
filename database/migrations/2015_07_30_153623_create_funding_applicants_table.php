<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_applicants', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('funding_application_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->float('allocation');
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('funding_application_id')->references('id')->on('funding_applications');
            $table->foreign('role_id')->references('id')->on('project_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('funding_applicants');
    }
}
