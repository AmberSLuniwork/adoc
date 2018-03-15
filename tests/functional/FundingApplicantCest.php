<?php
/**
 * Contains the FundingApplicant testing code.
 *
 * PHP Version 5
 *
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

use Bican\Roles\Models\Role;

use ADoc\Models\User;

/**
 * Tests the FundingApplicant functionality.
 */
class FundingApplicantCest
{
    /**
     * Setup the database user before the tests are run.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
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

    /**
     * Test the functionality for creating a new FundingApplicant.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testCreateFunder(FunctionalTester $I)
    {
        $I->wantTo('Create a new FundingApplicant');
        $I->amOnRoute('funding_app.applicant.create');
        $I->see('Add a new funding applicant');
        $I->fillField('name', 'Test Funder');
        $I->fillField('abbreviation', 'TF');
        $I->fillField('country', 'UK');
        $I->click('input[type=submit]');
        $I->seeRecord('funders', ['name' => 'Test Funder']);
    }

    /**
     * Test the Funder creation validation.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testCreateFunderInvalid(FunctionalTester $I)
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

    /**
     * Test viewing the full list of Funders.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testViewFunders(FunctionalTester $I)
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

    /**
     * Test viewing a single Funder.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testViewFunder(FunctionalTester $I)
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
    
    /**
     * Test updating a Funder.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testUpdateFunder(FunctionalTester $I)
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
    
    /**
     * Test deleting a Funder.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
/*    public function testDeleteFunder(FunctionalTester $I)
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
    }*/
}
