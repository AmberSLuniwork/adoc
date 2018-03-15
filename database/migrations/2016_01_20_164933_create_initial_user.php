<?php

use Bican\Roles\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use ADoc\Models\User;

class CreateInitialUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
        $contentCreator = Role::where('slug', 'content.creator')->first();
        $contentAdmin = Role::where('slug', 'content.admin')->first();
        $user->attachRole($contentCreator);
        $user->attachRole($contentAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
