<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * ProjectFunding.
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
use ADoc\Models\Project;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 */
class ProjectFundingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation is handled by checking whether the current User has access to the
     * Project that the ProjectFunding is linked to.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * ProjectFundings for their own Projects and users with the necessary permissions may
     * also do so.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        $project = Project::find($this->route()->getParameter('project'));
        if (in_array(
            $this->route()->getName(),
            ['project.funding.create', 'project.funding.store',
                'project.funding.edit', 'project.funding.update']
        )) {
            return Auth::check() && Auth::user()->allowed('project.edit', $project);
        } elseif ($this->route()->getName() === 'project.funding.destroy') {
            return Auth::check() && Auth::user()->allowed('project.destroy', $project);
        } else {
            return false;
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
        if (in_array($this->route()->getName(), ['project.funding.store', 'project.funding.update'])) {
            return [
                    'funding_application_id' => 'required|integer|exists:funding_applications,id',
                    'name' => 'required',
                    'amount' => 'required|numeric',
                    'currency' => 'required'
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * Updates the name-related rules to show nicely readable messages for the
     * person_id field.
     *
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     *
     * @return array The validation error messages.
     */
    public function messages()
    {
        return [
        'funding_application_id.required' => 'Please select an existing funding application',
        'funding_application_id.exists' => 'Please select an existing funding application'
        ];
    }
}
