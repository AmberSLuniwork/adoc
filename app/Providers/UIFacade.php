<?php
/**
 * Contains the UIFacade.
 *
 * PHP Version 5
 *
 * @package ADoc\Providers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Providers;

use Illuminate\Support\Facades\Facade;

/**
 * The UIFacade provides a Facade for the UIHelper helper functions.
 */
class UIFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string The static string "ui".
     */
    protected static function getFacadeAccessor()
    {
        return 'ui';
    }
}
