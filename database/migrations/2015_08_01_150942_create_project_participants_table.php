<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_participants', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->float('allocation');
            $table->timestamps();
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::drop('project_participants');
    }
}
