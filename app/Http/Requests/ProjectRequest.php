<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * Project.
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
use ADoc\Models\Project;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 */
class ProjectRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * their own Projects, users with the necessary permissions may also do so,
     * and other users may only view Projects that are set as "public".
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array($this->route()->getName(), ['project.create', 'project.store'])) {
            return Auth::check() && Auth::user()->can('project.create');
        } elseif (in_array($this->route()->getName(), ['project.edit', 'project.update'])) {
            $project = Project::find($this->route()->getParameter('project'));
            return Auth::check() && Auth::user()->allowed('project.edit', $project);
        } elseif ($this->route()->getName() === 'project.destroy') {
            $project = Project::find($this->route()->getParameter('project'));
            return Auth::check() && Auth::user()->allowed('project.destroy', $project);
        } elseif ($this->route()->getName() === 'project.show') {
            $project = Project::find($this->route()->getParameter('project'));
            if (Auth::check() && Auth::user()->allowed('project.view', $project)) {
                return true;
            } else {
                if ($project && $project->status === 'public') {
                    return true;
                } else {
                    return false;
                }
            }
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
        if (in_array(Route::currentRouteName(), ['project.store', 'project.update'])) {
            return [
            'title' => 'required|max:255',
            'acronym' => 'max:255',
            'summary' => 'required',
            'start' => 'date_format:Y-m-d',
            'end' => 'date_format:Y-m-d',
            'stage' => 'required|in:planning,active,inactive,completed',
            'status' => 'required|in:private,public'
            ];
        } else {
            return [];
        }
    }
}
