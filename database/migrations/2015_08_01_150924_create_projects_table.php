<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title');
            $table->string('acronym')->nullable();
            $table->text('summary');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('stage');
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        $createProjectPermission = Permission::create([
        		'name' => 'Create new projects',
        		'slug' => 'project.create'
        ]);
        $editProjectPermission = Permission::create([
        		'name' => 'Edit projects',
        		'slug' => 'project.edit'
        ]);
        $deleteProjectPermission = Permission::create([
        		'name' => 'Delete projects',
        		'slug' => 'project.delete'
        ]);
        $contentCreator = Role::where('slug', '=', 'content.creator')->first();
        $contentCreator->attachPermission($createProjectPermission);
        $contentCreator->attachPermission($editProjectPermission);
        $contentAdmin = Role::where('slug', '=', 'content.admin')->first();
        $contentAdmin->attachPermission($deleteProjectPermission);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
        Permission::where('slug', 'project.create')->delete();
        Permission::where('slug', 'project.edit')->delete();
        Permission::where('slug', 'project.delete')->delete();
    }
}
