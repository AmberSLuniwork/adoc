<?php
/**
 * Controller for the Project Role.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use ADoc\Http\Requests\ProjectRoleRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\ProjectRole;

/**
 * The ProjectRoleController provides the functionality for listing, showing, creating,
 * updating and deleting ProjectRoles.
 */
class ProjectRoleController extends Controller
{
    /**
     * Display a paginatable listing of ProjectRoles.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     *
     * @return Response The "project_role/index" view.
     */
    public function index(ProjectRoleRequest $request)
    {
        $project_roles = ProjectRole::orderBy('long', 'asc')->paginate(30);
        return view('project_role/index', ['project_roles' => $project_roles]);
    }

    /**
     * Show the form for creating a new ProjectRole.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     *
     * @return Response The "project_role/create" view.
     */
    public function create(ProjectRoleRequest $request)
    {
        return view('project_role/create');
    }

    /**
     * Store a newly created ProjectRole in storage.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     *
     * @return Response Redirect to "project_role.show" on success or "project_role.create" otherwise
     */
    public function store(ProjectRoleRequest $request)
    {
        $project_role = new ProjectRole();
        $project_role->fill($request->all());
        $project_role->save();
        return redirect()->route('project_role.show', [$project_role]);
    }

    /**
     * Display the specified ProjectRole.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     * @param int                $id      The unique identifier of the ProjectRole to show
     *
     * @return Response The "project_role/show" view
     */
    public function show(ProjectRoleRequest $request, $id)
    {
        $project_role = ProjectRole::findOrFail($id);
        return view('project_role/show', ['project_role' => $project_role]);
    }

    /**
     * Show the form for editing the specified ProjectRole.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     * @param int                $id      The unique identifier of the ProjectRole to edit
     *
     * @return Response The "project_role/edit" view
     */
    public function edit(ProjectRoleRequest $request, $id)
    {
        $project_role = ProjectRole::findOrFail($id);
        return view('project_role/edit', ['project_role' => $project_role]);
    }

    /**
     * Update the specified ProjectRole in storage.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     * @param int                $id      The unique identifier of the ProjectRole to update
     *
     * @return Response Redirect to "project_role.show" on success or "project_role.edit" otherwise
     */
    public function update(ProjectRoleRequest $request, $id)
    {
        $project_role = ProjectRole::findOrFail($id);
        $project_role->fill($request->all());
        $project_role->save();
        return redirect()->route('project_role.show', ['project_role' => $project_role]);
    }

    /**
     * Remove the specified ProjectRole from storage.
     *
     * @param ProjectRoleRequest $request The request to use for validation and authentication
     * @param int                $id      The unique identifier of the ProjectRole to remove
     *
     * @return Response Redirect to "qualification.index"
     */
    public function destroy(ProjectRoleRequest $request, $id)
    {
        $project_role = ProjectRole::findOrFail($id);
        $project_role->delete();
        return redirect()->route('project_role.index');
    }
}
