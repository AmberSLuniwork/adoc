<?php

use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $createQualificationPermission = Permission::create([
        		'name' => 'Create new qualifications',
        		'slug' => 'qualification.create'
        ]);
        $editQualificationPermission = Permission::create([
        		'name' => 'Edit qualifications',
        		'slug' => 'qualification.edit'
        ]);
        $deleteQualificationPermission = Permission::create([
        		'name' => 'Delete qualifications',
        		'slug' => 'qualification.delete'
        ]);
        $createFunderPermission = Permission::create([
        		'name' => 'Create new funders',
        		'slug' => 'funder.create'
        ]);
        $editFunderPermission = Permission::create([
        		'name' => 'Edit funders',
        		'slug' => 'funder.edit'
        ]);
        $deleteFunderPermission = Permission::create([
        		'name' => 'Delete funders',
        		'slug' => 'funder.delete'
        ]);
        $viewPersonPermission = Permission::create([
        		'name' => 'View all people',
        		'slug' => 'person.view',
        		'model' => 'ADoc\Models\Person'
        ]);
        $createPersonPermission = Permission::create([
        		'name' => 'Create new people',
        		'slug' => 'person.create'
        ]);
        $editPersonPermission = Permission::create([
        		'name' => 'Edit people',
        		'slug' => 'person.edit',
        		'model' => 'ADoc\Models\Person'
        ]);
        $deletePersonPermission = Permission::create([
        		'name' => 'Delete people',
        		'slug' => 'person.delete',
        		'model' => 'ADoc\Models\Person'
        ]);
        $viewFundingApplicationPermission = Permission::create([
        		'name' => 'View all funding applications',
        		'slug' => 'fundingapplication.view',
        		'model' => 'ADoc\Models\FundingApplication'
        ]);
        $createFundingApplicationPermission = Permission::create([
        		'name' => 'Create new funding application',
        		'slug' => 'fundingapplication.create'
        ]);
        $editFundingApplicationPermission = Permission::create([
        		'name' => 'Edit all funding applications',
        		'slug' => 'fundingapplication.edit',
        		'model' => 'ADoc\Models\FundingApplication'
        ]);
        $deleteFundingApplicationPermission = Permission::create([
        		'name' => 'Delete funding applications',
        		'slug' => 'fundingapplication.delete',
        		'model' => 'ADoc\Models\FundingApplication'
        ]);
        $contentCreator = Role::create([
        		'name' => 'Content Creator',
        		'slug' => 'content.creator'
        ]);
        $contentCreator->attachPermission($createQualificationPermission);
        $contentCreator->attachPermission($editQualificationPermission);
        $contentCreator->attachPermission($createFunderPermission);
        $contentCreator->attachPermission($editFunderPermission);
        $contentCreator->attachPermission($createPersonPermission);
        $contentCreator->attachPermission($createFundingApplicationPermission);
        $contentAdmin = Role::create([
        		'name' => 'Content Administrator',
        		'slug' => 'content.admin'
        ]);
        $contentAdmin->attachPermission($viewPersonPermission);
        $contentAdmin->attachPermission($viewFundingApplicationPermission);
        $contentAdmin->attachPermission($editPersonPermission);
        $contentAdmin->attachPermission($editFundingApplicationPermission);
        $contentAdmin->attachPermission($deleteQualificationPermission);
        $contentAdmin->attachPermission($deleteFunderPermission);
        $contentAdmin->attachPermission($deleteFundingApplicationPermission);
        $contentAdmin->attachPermission($deletePersonPermission);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	$contentCreator = Role::where('slug', 'content.creator')->first();
    	$contentCreator->detachAllPermissions();
    	$contentCreator->delete();
    	$contentAdmin = Role::where('slug', 'content.admin')->first();
    	$contentAdmin->detachAllPermissions();
    	$contentAdmin->delete();
    	Permission::where('slug', 'qualification.create')->delete();
        Permission::where('slug', 'qualification.edit')->delete();
        Permission::where('slug', 'qualification.delete')->delete();
    	Permission::where('slug', 'funder.create')->delete();
        Permission::where('slug', 'funder.edit')->delete();
        Permission::where('slug', 'funder.delete')->delete();
        Permission::where('slug', 'person.view')->delete();
        Permission::where('slug', 'person.create')->delete();
        Permission::where('slug', 'person.edit')->delete();
        Permission::where('slug', 'person.delete')->delete();
        Permission::where('slug', 'fundingapplication.view')->delete();
        Permission::where('slug', 'fundingapplication.create')->delete();
        Permission::where('slug', 'fundingapplication.edit')->delete();
        Permission::where('slug', 'fundingapplication.delete')->delete();
    }
}
