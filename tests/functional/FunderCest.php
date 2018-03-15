<?php
use Bican\Roles\Models\Role;

use ADoc\Models\User;

class FunderCest
{
    public function _before(FunctionalTester $I)
    {
        $I->haveRecord('users', [
            'name' => 'Test 1',
            'email' =>  'test1@example.com',
            'password' => bcrypt('password'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $user = User::where('email', 'test1@example.com')->first();
        $user->attachRole(Role::where('slug', 'content.creator')->first());
        $user->attachRole(Role::where('slug', 'content.admin')->first());
        $I->amLoggedAs($user);
    }

    public function testCreateFunder(FunctionalTester $I)
    {
        $I->wantTo('Create a new Funder');
        $I->amOnRoute('funder.create');
        $I->see('Add a new funder');
        $I->fillField('name', 'Test Funder');
        $I->fillField('abbreviation', 'TF');
        $I->fillField('country', 'UK');
        $I->click('input[type=submit]');
        $I->seeRecord('funders', ['name' => 'Test Funder']);
    }

    public function testCreateFunderInvalid(FunctionalTester $I)
    {
        $I->wantTo('Fail to create an invalid Funder');
        $I->amOnRoute('funder.create');
        $I->see('Add a new funder');
        $I->fillField('name', '');
        $I->fillField('abbreviation', 'TF');
        $I->fillField('country', 'UK');
        $I->click('input[type=submit]');
        $I->seeFormHasErrors();
        $I->seeFormErrorMessage('name', 'The name field is required.');
        $I->dontSeeRecord('funders', ['abbreviation' => 'TF']);
        $I->amOnRoute('funder.create');
        $I->see('Add a new funder');
        $I->fillField('name', 'Test Funder');
        $I->fillField('abbreviation', '');
        $I->fillField('country', 'UK');
        $I->click('input[type=submit]');
        $I->seeFormHasErrors();
        $I->seeFormErrorMessage('abbreviation', 'The abbreviation field is required.');
        $I->dontSeeRecord('funders', ['abbreviation' => 'Test Funder']);
        $I->amOnRoute('funder.create');
        $I->see('Add a new funder');
        $I->fillField('name', 'Test Funder');
        $I->fillField('abbreviation', 'TF');
        $I->fillField('country', '');
        $I->click('input[type=submit]');
        $I->seeFormHasErrors();
        $I->seeFormErrorMessage('country', 'The country field is required.');
        $I->dontSeeRecord('funders', ['abbreviation' => 'Test Funder']);
    }

    public function testViewFunders(FunctionalTester $I)
    {
        $I->wantTo('View all Funders');
        $id = $I->haveRecord('funders', [
            'name' => 'Test Funder',
            'abbreviation' =>  'TF',
            'country' => 'UK',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->amOnRoute('funder.index');
        $I->see('Funders');
        $I->see('Test Funder');
    }

    public function testViewFunder(FunctionalTester $I)
    {
        $I->wantTo('View a Funder');
        $id = $I->haveRecord('funders', [
            'name' => 'Test Funder',
            'abbreviation' =>  'TF',
            'country' => 'UK',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->amOnRoute('funder.show', [$id]);
        $I->see('Test Funder');
        $I->see('TF');
        $I->see('UK');
    }
    
    public function testUpdateFunder(FunctionalTester $I)
    {
        $I->wantTo('Update a Funder');
        $id = $I->haveRecord('funders', [
            'name' => 'Test Funder',
            'abbreviation' =>  'TF',
            'country' => 'UK',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->amOnRoute('funder.edit', [$id]);
        $I->fillField('name', 'Updated Funder');
        $I->fillField('abbreviation', 'UF');
        $I->fillField('country', 'GB');
        $I->click('input[type=submit]');
        $I->see('Updated Funder');
        $I->see('UF');
        $I->see('GB');
    }
    
    public function testDeleteFunder(FunctionalTester $I)
    {
        $I->wantTo('Delete a Funder');
        $id = $I->haveRecord('funders', [
            'name' => 'Test Funder',
            'abbreviation' =>  'TF',
            'country' => 'UK',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->amOnRoute('funder.show', [$id]);
        $I->click('Delete');
        $I->dontSeeRecord('funders', ['name' => 'Test Funder']);
    }
}
