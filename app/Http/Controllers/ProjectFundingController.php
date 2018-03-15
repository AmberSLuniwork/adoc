<?php
/**
 * Controller for the ProjectFunding.
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
use ADoc\Http\Requests\ProjectFundingRequest;
use ADoc\Models\Project;
use ADoc\Models\ProjectFunding;
use ADoc\Models\ProjectRole;

/**
 * The ProjectFundingController provides the functionality for adding and
 * removing FundingApplications to/from Projects.
 *
 * Only the create/update/delete endpoints are implemented. All other endpoints
 * redirect to the appropriate endpoint in the ProjectController.
 */
class ProjectFundingController extends Controller
{
    /**
     * Redirect to the "project.show" route.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project to redirect to
     *
     * @return Response Redirection response
     */
    public function index(ProjectFundingRequest $request, $pid)
    {
        return redirect()->route('project.show', $pid);
    }

    /**
     * Show the form for creating a new ProjectFunding.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project to add the ProjectFunding to
     *
     * @return Response The "project/participant/create" view.
     */
    public function create(ProjectFundingRequest $request, $pid)
    {
        $project = Project::findOrFail($pid);
        return view('project/funding/create', ['project' => $project]);
    }

    /**
     * Store a newly created ProjectFunding in storage.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project to add the ProjectFunding to
     *
     * @return Response Redirect to "project.show" on success or "project.participant.create" otherwise
     */
    public function store(ProjectFundingRequest $request, $pid)
    {
        $project = Project::findOrFail($pid);
        $funding = new ProjectFunding();
        $funding->fill($request->all());
        $funding->project_id = $pid;
        $funding->save();
        return redirect()->route('project.show', $pid);
    }

    /**
     * Redirect to the "project.show" route.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project to redirect to
     * @param Integer               $pfid    The id of the ProjectFunding to show
     *
     * @return Response Redirection response
     */
    public function show(ProjectFundingRequest $request, $pid, $pfid)
    {
        return redirect()->route('project.show', $pid);
    }

    /**
     * Show the form for editing the specified ProjectFunding.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project that the ProjectFunding belongs to
     * @param Integer               $pfid    The id of the ProjectFunding to edit
     *
     * @return Response The "project/participant/edit" view.
     */
    public function edit(ProjectFundingRequest $request, $pid, $pfid)
    {
        $project = Project::findOrFail($pid);
        $funding = ProjectFunding::where('project_id', '=', $pid)->where('id', '=', $pfid)->firstOrFail();
        $funding->name = $funding->fundingApplication()->title;
        return view(
            'project/funding/edit',
            [
            'project' => $project,
            'funding' => $funding,
            ]
        );
    }

    /**
     * Update the specified ProjectFunding in storage.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project that the ProjectFunding belongs to
     * @param Integer               $pfid    The id of the ProjectFunding to update
     *
     * @return Response Redirect to "project.show" on success or "project.participant.edit" otherwise
     */
    public function update(ProjectFundingRequest $request, $pid, $pfid)
    {
        $project = Project::findOrFail($pid);
        $funding = ProjectFunding::where('project_id', '=', $pid)->where('id', '=', $pfid)->firstOrFail();
        $funding->fill($request->all());
        $funding->save();
        return redirect()->route('project.show', $pid);
    }

    /**
     * Remove the specified ProjectFunding from storage.
     *
     * @param ProjectFundingRequest $request The request to use for validation
     * @param Integer               $pid     The id of the Project that the ProjectFunding belongs to
     * @param Integer               $pfid    The id of the ProjectFunding to delete
     *
     * @return Response Redirect to "project.show"
     */
    public function destroy(ProjectFundingRequest $request, $pid, $pfid)
    {
        $project = Project::findOrFail($pid);
        $funding = ProjectFunding::where('project_id', '=', $pid)->where('id', '=', $pfid)->firstOrFail();
        $funding->delete();
        return redirect()->route('project.show', $pid);
    }
}
