<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * ProjectParticipant.
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
class ProjectParticipantRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation is handled by checking whether the current User has access to the
     * Project that the ProjectParticipant is linked to.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * ProjectParticipants for their own Projects and users with the necessary permissions may
     * also do so.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        $project = Project::find($this->route()->getParameter('project'));
        if (in_array(
            $this->route()->getName(),
            ['project.participant.create', 'project.participant.store',
                'project.participant.edit', 'project.participant.update']
        )) {
            return Auth::check() && Auth::user()->allowed('project.edit', $project);
        } elseif ($this->route()->getName() === 'project.participant.destroy') {
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
        if (in_array($this->route()->getName(), ['project.participant.store', 'project.participant.update'])) {
            return [
                    'person_id' => 'required|integer|exists:people,id',
                    'name' => 'required',
                    'role_id' => 'required|integer|exists:project_roles,id',
                    'allocation' => 'numeric'
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
        'person_id.required' => 'Please select an existing person',
        'person_id.exists' => 'Please select an existing person'
        ];
    }
}
