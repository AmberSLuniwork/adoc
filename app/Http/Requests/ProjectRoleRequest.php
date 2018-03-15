<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * ProjectRole.
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
 */
class ProjectRoleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the auxilliary pattern that users with the necessary
     * permissions may create/edit/delete ProjectRoles and other users may only view
     * ProjectRoles.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array($this->route()->getName(), ['project_role.create', 'project_role.store'])) {
            return Auth::check() && Auth::user()->can('projectrole.create');
        } elseif (in_array($this->route()->getName(), ['project_role.edit', 'project_role.update'])) {
            return Auth::check() && Auth::user()->can('projectrole.edit');
        } elseif ($this->route()->getName() == 'project_role.destroy') {
            return Auth::check() && Auth::user()->can('projectrole.delete');
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
        if (in_array($this->route()->getName(), ['project_role.store', 'project_role.update'])) {
            return [
            'long' => 'required|max:255',
            'short' => 'required|max:255'
            ];
        } else {
            return [];
        }
    }
}
