<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * Funder.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Auth;
use Route;

use ADoc\Http\Requests\Request;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 *
 * @package ADoc\Http\Requests
 */
class FunderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the auxilliary pattern that users with the necessary
     * permissions may create/edit/delete Funders and other users may only view
     * Funders.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array($this->route()->getName(), ['funder.create', 'funder.store'])) {
            return Auth::check() && Auth::user()->can('funder.create');
        } elseif (in_array($this->route()->getName(), ['funder.edit', 'funder.update'])) {
            return Auth::check() && Auth::user()->can('funder.edit');
        } elseif ($this->route()->getName() == 'funder.destroy') {
            return Auth::check() && Auth::user()->can('funder.delete');
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Validation rules are only created for the "store" and "update" routes.
     *
     * @return array The validation rules as an associative array
     */
    public function rules()
    {
        if (in_array(Route::currentRouteName(), ['funder.store', 'funder.update'])) {
            return [
            'name' => 'required|max:255',
            'abbreviation' => 'required|max:255',
            'country' => 'required|max:255'
            ];
        } else {
            return [];
        }
    }
}
