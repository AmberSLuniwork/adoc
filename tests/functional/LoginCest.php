<?php
/**
 * Contains the login testing code.
 *
 * PHP Version 5
 *
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

/**
 * Tests the login functionality.
 */
class LoginCest
{
    /**
     * Test setup.
     * 
     * For each test create a valid user and go to the "auth.login" route.
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
        $I->seeRecord('users', ['email' => 'test1@example.com']);
        $I->amOnRoute('auth.login');
        $I->see('Login');
    }

    /**
     * Test a valid login.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testLogin(FunctionalTester $I)
    {
        $I->wantTo('Successfully log in');
        $I->fillField('email', 'test1@example.com');
        $I->fillField('password', 'password');
        $I->click('input[type=submit]');
        $I->amOnRoute('root');
        $I->seeAuthentication();
    }

    /**
     * Tests a failed login with no email address.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testNoEmail(FunctionalTester $I)
    {
        $I->wantTo('Fail to login with no email address');
        $I->fillField('email', '');
        $I->fillField('password', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/login');
        $I->see('The email field is required.');
        $I->dontSeeAuthentication();
    }
    
    /**
     * Tests a failed login with an invalid email address.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testInvalidEmail(FunctionalTester $I)
    {
        $I->wantTo('Fail to login with an invalid email address');
        $I->fillField('email', 'test1');
        $I->fillField('password', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/login');
        $I->see('These credentials do not match our records.');
        $I->dontSeeAuthentication();
    }
    
    /**
     * Tests a failed login with no password.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testNoPassword(FunctionalTester $I)
    {
        $I->wantTo('Fail to login with no email address');
        $I->fillField('email', 'test1@example.come');
        $I->fillField('password', '');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/login');
        $I->see('The password field is required.');
        $I->dontSeeAuthentication();
    }
    
    /**
     * Tests a failed login with invalid credentials.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testInvalidCredentials(FunctionalTester $I)
    {
        $I->wantTo('Fail to login with no email address');
        $I->fillField('email', 'test2@example.com^');
        $I->fillField('password', 'password');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/login');
        $I->see('These credentials do not match our records.');
        $I->dontSeeAuthentication();
        $I->fillField('email', 'test1@example.com^');
        $I->fillField('password', 'testing');
        $I->click('input[type=submit]');
        $I->seeCurrentUrlEquals('/auth/login');
        $I->see('These credentials do not match our records.');
        $I->dontSeeAuthentication();
    }
}
