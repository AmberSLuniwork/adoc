<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('long');
            $table->string('short');
            $table->timestamps();
        });
        $createProjectRolePermission = Permission::create([
        		'name' => 'Create new project role',
        		'slug' => 'projectrole.create'
        ]);
        $editProjectRolePermission = Permission::create([
        		'name' => 'Edit project roles',
        		'slug' => 'projectrole.edit'
        ]);
        $deleteProjectRolePermission = Permission::create([
        		'name' => 'Delete project roles',
        		'slug' => 'projectrole.delete'
        ]);
        $contentCreator = Role::where('slug', '=', 'content.creator')->first();
        $contentCreator->attachPermission($createProjectRolePermission);
        $contentCreator->attachPermission($editProjectRolePermission);
        $contentAdmin = Role::where('slug', '=', 'content.admin')->first();
        $contentAdmin->attachPermission($deleteProjectRolePermission);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_roles');
        Permission::where('slug', 'projectrole.create')->delete();
        Permission::where('slug', 'projectrole.edit')->delete();
        Permission::where('slug', 'projectrole.delete')->delete();
    }
}
