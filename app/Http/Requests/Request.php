<?php
/**
 * Contains the base Request
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * The abstract Request extends the Laravel FormRequest and forms the base class
 * for all resource-specific requests.
 *
 * @package ADoc\Http\Requests
 */
abstract class Request extends FormRequest
{
    /**
     * Handle the forbidden response by sending a 403 error.
     *
     * @see \Illuminate\Foundation\Http\FormRequest::forbiddenResponse()
     *
     * @return Response 403 error
     */
    public function forbiddenResponse()
    {
        return abort(403);
    }
}
