<?php
/**
 * Contains the registration testing code.
 *
 * PHP Version 5
 *
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

use ADoc\Models\User;

/**
 * Tests the registration functionality.
 */
class RegisterCest
{
    /**
     * Test the registration functionality for a valid user
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterUser(FunctionalTester $I)
    {
        $I->wantTo('Register a new user');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', 'Test 1');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('input[type=submit]');
        $I->amOnRoute('root');
        $I->seeAuthentication();
        $I->seeRecord('users', ['email' => 'test1@example.com']);
    }

    /**
     * Test the registration functionality for a duplicate user
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterDuplicateUser(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a duplicate user');
        $I->haveRecord('users', [
            'name' => 'Test 1',
            'email' =>  'test1@example.com',
            'password' => bcrypt('password'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        $I->seeRecord('users', ['email' => 'test1@example.com']);
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', 'Test 1');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The email has already been taken.');
    }

    /**
     * Test the registration functionality for incorrect registration information
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterNoName(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a user with no name');
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', '');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The name field is required.');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
    }
    
    /**
     * Test the registration functionality for incorrect registration information
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterInvalidEmail(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a user with an invalid email');
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', 'Test 1');
        $I->fillField('email', 'test1');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The email must be a valid email address.');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
    }
    
    /**
     * Test the registration functionality for incorrect registration information
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterNoPassword(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a user with no password');
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', 'Test 1');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', '');
        $I->fillField('password_confirmation', '');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The password field is required.');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
    }

    /**
     * Test the registration functionality for incorrect registration information
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterShortPassword(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a user with too short a password');
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', '');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'test');
        $I->fillField('password_confirmation', 'test');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The password must be at least 6 characters.');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
    }
    
    /**
     * Test the registration functionality for incorrect registration information
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testRegisterConfirmPassword(FunctionalTester $I)
    {
        $I->wantTo('Fail registering a user with non-matching passwords');
        $I->amOnRoute('auth.register');
        $I->see('Register');
        $I->fillField('name', '');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'password1');
        $I->fillField('password_confirmation', 'password2');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/register');
        $I->see('The password confirmation does not match.');
        $I->dontSeeRecord('users', ['email' => 'test1@example.com']);
    }
}
