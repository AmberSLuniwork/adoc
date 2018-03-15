<?php
/**
 * Controller for the ProjectParticipant.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Illuminate\Http\Request;

use ADoc\Http\Controllers\Controller;
use ADoc\Http\Requests\ProjectParticipantRequest;
use ADoc\Models\Project;
use ADoc\Models\ProjectParticipant;
use ADoc\Models\ProjectRole;

/**
 * The ProjectParticipantController provides the functionality for adding and
 * removing Person to/from Projects.
 *
 * Only the create/update/delete endpoints are implemented. All other endpoints
 * redirect to the appropriate endpoint in the ProjectController.
 */
class ProjectParticipantController extends Controller
{
    /**
     * Redirect to the "project.show" route.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project to redirect to
     *
     * @return Response Redirection response
     */
    public function index(ProjectParticipantRequest $request, $pid)
    {
        return redirect()->route('project.show', $pid);
    }

    /**
     * Show the form for creating a new ProjectParticipant.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project to add the ProjectParticipant to
     *
     * @return Response The "project/participant/create" view.
     */
    public function create(ProjectParticipantRequest $request, $pid)
    {
        $project = Project::findOrFail($pid);
        $project_roles = [];
        foreach (ProjectRole::orderBy('long', 'asc')->get() as $project_role) {
            $project_roles[$project_role->id] = $project_role->long;
        }
        return view('project/participant/create', ['project' => $project, 'project_roles' => $project_roles]);
    }

    /**
     * Store a newly created ProjectParticipant in storage.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project to add the ProjectParticipant to
     *
     * @return Response Redirect to "project.show" on success or "project.participant.create" otherwise
     */
    public function store(ProjectParticipantRequest $request, $pid)
    {
        $project = Project::findOrFail($pid);
        $participant = new ProjectParticipant();
        $participant->fill($request->all());
        $participant->project_id = $pid;
        $participant->save();
        return redirect()->route('project.show', $pid);
    }

    /**
     * Redirect to the "project.show" route.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project to redirect to
     * @param Integer                   $ppid    The id of the ProjectParticipant to show
     *
     * @return Response Redirection response
     */
    public function show(ProjectParticipantRequest $request, $pid, $ppid)
    {
        return redirect()->route('project.show', $pid);
    }

    /**
     * Show the form for editing the specified ProjectParticipant.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project that the ProjectParticipant belongs to
     * @param Integer                   $ppid    The id of the ProjectParticipant to edit
     *
     * @return Response The "project/participant/edit" view.
     */
    public function edit(ProjectParticipantRequest $request, $pid, $ppid)
    {
        $project = Project::findOrFail($pid);
        $participant = ProjectParticipant::where('project_id', '=', $pid)->where('id', '=', $ppid)->first();
        if ($participant === null) {
            return abort(404);
        }
        $participant->name = $participant->person()->fullName();
        $project_roles = [];
        foreach (ProjectRole::orderBy('long', 'asc')->get() as $project_role) {
            $project_roles[$project_role->id] = $project_role->long;
        }
        return view(
            'project/participant/edit',
            [
            'project' => $project,
            'participant' => $participant,
            'project_roles' => $project_roles
            ]
        );
    }

    /**
     * Update the specified ProjectParticipant in storage.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project that the ProjectParticipant belongs to
     * @param Integer                   $ppid    The id of the ProjectParticipant to update
     *
     * @return Response Redirect to "project.show" on success or "project.participant.edit" otherwise
     */
    public function update(ProjectParticipantRequest $request, $pid, $ppid)
    {
        $project = Project::findOrFail($pid);
        $participant = ProjectParticipant::where('project_id', '=', $pid)->where('id', '=', $ppid)->first();
        if ($participant === null) {
            return abort(404);
        }
        $participant->fill($request->all());
        $participant->save();
        return redirect()->route('project.show', $pid);
    }

    /**
     * Remove the specified ProjectParticipant from storage.
     *
     * @param ProjectParticipantRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Project that the ProjectParticipant belongs to
     * @param Integer                   $ppid    The id of the ProjectParticipant to delete
     *
     * @return Response Redirect to "project.show"
     */
    public function destroy(ProjectParticipantRequest $request, $pid, $ppid)
    {
        $project = Project::findOrFail($pid);
        $participant = ProjectParticipant::where('project_id', '=', $pid)->where('id', '=', $ppid)->first();
        if ($participant === null) {
            return abort(404);
        }
        $participant->delete();
        return redirect()->route('project.show', $pid);
    }
}
