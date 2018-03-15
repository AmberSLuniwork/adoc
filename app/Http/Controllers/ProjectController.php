<?php
/**
 * Controller for the Project.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use ADoc\Http\Requests\ProjectRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\Project;

/**
 * The ProjectController provides the functionality for listing, showing, creating,
 * updating and deleting Projects.
 */
class ProjectController extends Controller
{
    /**
     * Display a paginatable listing of Projects.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     *
     * @return Response The "project/index" view
     */
    public function index(ProjectRequest $request)
    {
        if (Auth::check() && Auth::user()->can('projects.view')) {
            $projects = Project::orderBy('end', 'desc')->orderBy('start', 'desc')
                ->orderBy('title', 'asc')->paginate(10);
        } elseif (Auth::check()) {
            $projects = Project::where('status', 'public')->orWhere('user_id', Auth::user()->id)
                ->orderBy('end', 'desc')->orderBy('start', 'desc')->orderBy('title', 'asc')->paginate(10);
        } else {
            $projects = Project::where('status', 'public')
                ->orderBy('end', 'desc')->orderBy('start', 'desc')->orderBy('title', 'asc')->paginate(10);
        }
        return view('project/index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new Project.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     *
     * @return Response The "project/create" view.
     */
    public function create(ProjectRequest $request)
    {
        return view('project/create');
    }

    /**
     * Store a newly created Project in storage.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     *
     * @return Response Redirect to "project.show" if successful or "project.create" otherwise
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project();
        $project->fill($request->all());
        $project->user_id = Auth::user()->id;
        if ($request->get('acronym') === '') {
            $project->acronym = null;
        }
        if ($request->get('start') === '') {
            $project->start = null;
        }
        if ($request->get('end') === '') {
            $project->end = null;
        }
        $project->save();
        return redirect()->route('project.show', $project);
    }

    /**
     * Display the specified Project.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     * @param int            $id      The unique identifier of the Project to show
     *
     * @return Response The "project/show" view
     */
    public function show(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        return view('project/show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     * @param int            $id      The unique identifier of the Project to edit
     *
     * @return Response The "project/edit" view
     */
    public function edit(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        return view('project/edit', ['project' => $project]);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     * @param int            $id      The unique identifier of the Project to update
     *
     * @return Response Redirect to "project.show" if successful or "project.edit" otherwise
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->fill($request->all());
        if ($request->get('acronym') === '') {
            $project->acronym = null;
        }
        if ($request->get('start') === '') {
            $project->start = null;
        }
        if ($request->get('end') === '') {
            $project->end = null;
        }
        $project->save();
        return redirect()->route('project.show', $project);
    }

    /**
     * Remove the specified Project from storage.
     *
     * @param ProjectRequest $request The request to use for validation and authentication
     * @param int            $id      The unique identifier of the Project to remove
     *
     * @return Response Redirect to "project.index"
     */
    public function destroy(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->participants()->delete();
        $project->delete();
        return redirect()->route('project.index');
    }
}
