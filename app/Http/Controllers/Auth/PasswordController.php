<?php
/**
 * Contains the PasswordController provided by Laravel.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers\Auth
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers\Auth;

use ADoc\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * The PasswordController handles the functionality for resetting user passwords,
 * based on including the ResetsPasswords trait.
 *
 * @package ADoc\Http\Controllers\Auth
 */
class PasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
