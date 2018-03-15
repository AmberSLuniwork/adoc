<?php
/**
 * CSRF verification middleware
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Middleware
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

/**
 * The VerifyCsrfToken middleware that verifies the CSRF token.
 *
 * Extends the BaseVerifier and provides the option to exclude specific URIs
 * from the CSRF verification.
 *
 * @package ADoc\Http\Middleware
 */
class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
