<?php
/**
 * Controller for the FundingApplicant.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Illuminate\Http\Request;

use ADoc\Http\FundingApplicantRequests;
use ADoc\Http\Controllers\Controller;
use ADoc\Http\Requests\FundingApplicantRequest;
use ADoc\Models\FundingApplication;
use ADoc\Models\FundingApplicant;
use ADoc\Models\ProjectRole;

/**
 * The FundingApplicationController provides the functionality for adding and
 * removing Person to/from FundingApplications.
 *
 * Only the create/update/delete endpoints are implemented. All other endpoints
 * redirect to the appropriate endpoint in the FundingApplicationController.
 */
class FundingApplicantController extends Controller
{
    /**
     * Redirect to the "funding_app.show" route.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication to redirect to
     *
     * @return Response Redirection response
     */
    public function index(FundingApplicantRequest $request, $fid)
    {
        return redirect()->route('funding_app.show', $fid);
    }

    /**
     * Show the form for creating a new FundingApplicant.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication to add the FundingApplicant to
     *
     * @return Response The "funding_app/applicant/create" view.
     */
    public function create(FundingApplicantRequest $request, $fid)
    {
        $funding_app = FundingApplication::findOrFail($fid);
        $project_roles = [];
        foreach (ProjectRole::orderBy('long', 'asc')->get() as $project_role) {
            $project_roles[$project_role->id] = $project_role->long;
        }
        return view('funding_app/applicant/create', ['funding_app' => $funding_app, 'project_roles' => $project_roles]);
    }

    /**
     * Store a newly created FundingApplicant in storage.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication to add the FundingApplicant to
     *
     * @return Response Redirect to "funding_app.show" on success or "funding_app.applicant.create" otherwise
     */
    public function store(FundingApplicantRequest $request, $fid)
    {
        $funding_app = FundingApplication::findOrFail($fid);
        $applicant = new FundingApplicant();
        $applicant->fill($request->all());
        $applicant->funding_application_id = $fid;
        $applicant->save();
        return redirect()->route('funding_app.show', $fid);
    }

    /**
     * Redirect to the "funding_app.show" route.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication to redirect to
     * @param Integer                   $aid     The id of the FundingApplicant to show
     *
     * @return Response Redirection response
     */
    public function show(FundingApplicantRequest $request, $fid, $aid)
    {
        return redirect()->route('funding_app.show', $fid);
    }

    /**
     * Show the form for editing the specified FundingApplicant.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication that the FundingApplicant belongs to
     * @param Integer                   $aid     The id of the FundingApplicant to edit
     *
     * @return Response The "funding_app/applicant/edit" view.
     */
    public function edit(FundingApplicantRequest $request, $fid, $aid)
    {
        $funding_app = FundingApplication::findOrFail($fid);
        $applicant = FundingApplicant::where('funding_application_id', '=', $fid)
            ->where('id', '=', $aid)->firstOrFail();
        $applicant->name = $applicant->person()->fullName();
        $project_roles = [];
        foreach (ProjectRole::orderBy('long', 'asc')->get() as $project_role) {
            $project_roles[$project_role->id] = $project_role->long;
        }
        return view(
            'funding_app/applicant/edit',
            [
            'funding_app' => $funding_app,
            'applicant' => $applicant,
            'project_roles' => $project_roles
            ]
        );
    }

    /**
     * Update the specified FundingApplicant in storage.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication that the FundingApplicant belongs to
     * @param Integer                   $aid     The id of the FundingApplicant to edit
     *
     * @return Response Redirect to "funding_app.show"
     */
    public function update(FundingApplicantRequest $request, $fid, $aid)
    {
        $funding_app = FundingApplication::findOrFail($fid);
        $applicant = FundingApplicant::where('funding_application_id', '=', $fid)
            ->where('id', '=', $aid)->firstOrFail();
        $applicant->fill($request->all());
        $applicant->save();
        return redirect()->route('funding_app.show', $fid);
    }

    /**
     * Remove the specified FundingApplicant from storage.
     *
     * @param FundingApplicationRequest $request The request to use for validation
     * @param Integer                   $fid     The id of the FundingApplication that the FundingApplicant belongs to
     * @param Integer                   $aid     The id of the FundingApplicant to delete
     *
     * @return Response Redirect to "funding_app.show"
     */
    public function destroy(FundingApplicantRequest $request, $fid, $aid)
    {
        $funding_app = FundingApplication::findOrFail($fid);
        $applicant = FundingApplicant::where('funding_application_id', '=', $fid)
            ->where('id', '=', $aid)->firstOrFail();
        $applicant->delete();
        return redirect()->route('funding_app.show', $fid);
    }
}
