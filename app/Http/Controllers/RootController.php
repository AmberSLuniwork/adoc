<?php
/**
 * Controller for the generic routes.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use ADoc\Http\Requests;
use ADoc\Http\Controllers\Controller;

/**
 * The RootController handles all generic routes such as the "root" route.
 *
 * @package ADoc\Http\Controllers
 */
class RootController extends Controller
{
    /**
     * Shows the static "root" view.
     *
     * @return Response The "root" view.
     */
    public function root()
    {
        return view('root');
    }
}
