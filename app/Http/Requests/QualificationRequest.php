<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * Qualification.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Auth;

use ADoc\Http\Requests\Request;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 *
 * @package ADoc\Http\Requests
 */
class QualificationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the auxilliary pattern that users with the necessary
     * permissions may create/edit/delete Qualifications and other users may only view
     * Qualifications.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array($this->route()->getName(), ['qualification.create', 'qualification.store'])) {
            return Auth::check() && Auth::user()->can('qualification.create');
        } elseif (in_array($this->route()->getName(), ['qualification.edit', 'qualification.update'])) {
            return Auth::check() && Auth::user()->can('qualification.edit');
        } elseif ($this->route()->getName() == 'qualification.destroy') {
            return Auth::check() && Auth::user()->can('qualification.delete');
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
        if (in_array($this->route()->getName(), ['qualification.store', 'qualification.update'])) {
            return [
            'long' => 'required|max:255',
            'short' => 'required|max:255',
            'position' => 'required|in:after,before',
            'weight' => 'required|integer'
            ];
        } else {
            return [];
        }
    }
}
