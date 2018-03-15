<?php
/**
 * Contains the root view testing code.
 *
 * PHP Version 5
 *
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

/**
 * Tests the root view and error views.
 */
class RootCest
{
    /**
     * Test that the / root view works.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function testLandingPage(FunctionalTester $I)
    {
        $I->wantTo('Test the landing page');
        $I->amOnRoute('root');
        $I->see('Academic documentation');
    }

    /**
     * Tests that a 404 error is sent on an non-existent URL.
     *
     * @param FunctionalTester $I The test instance to use.
     */
    public function test404Page(FunctionalTester $I)
    {
        $I->wantTo('Test the 404 page');
        $I->amOnPage('/url-that-certainly-does-not-exist');
        $I->seePageNotFound();
        $I->see('404 Not Found');
    }
    
    /**
     * Tests that a 403 error is sent on an non-logged in access to a protected page.
     * 
     * @param FunctionalTester $I The test instance to use.
     */
    public function test403Page(FunctionalTester $I)
    {
        $I->wantTo('Test the 403 page');
        $I->amOnRoute('funder.create');
        $I->seeResponseCodeIs(403);
        $I->see('403 Forbidden');
    }
}
