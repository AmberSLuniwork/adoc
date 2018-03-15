<?php
/**
 * Controller for the FundingApplication.
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

use ADoc\Http\Requests\FundingApplicationRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\Funder;
use ADoc\Models\FundingApplication;

/**
 * The FundingApplicationController provides the functionality for listing, showing, creating,
 * updating and deleting FundingApplications.
 *
 * @package ADoc\Http\Controllers
 */
class FundingApplicationController extends Controller
{
    /**
     * Display a paginatable listing of FundingApplications.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     *
     * @return Response The "funding_app/index" view
     */
    public function index(FundingApplicationRequest $request)
    {
        if (Auth::check() && Auth::user()->can('fundingapplication.view')) {
            $funding_apps = FundingApplication::orderBy('submission_date', 'desc')
                ->orderBy('title', 'asc')->paginate(10);
        } elseif (Auth::check()) {
            $funding_apps = FundingApplication::where('status', 'public')->orWhere('user_id', Auth::user()->id)
                ->orderBy('submission_date', 'desc')->orderBy('title', 'asc')->paginate(10);
        } else {
            $funding_apps = FundingApplication::where('status', 'public')->where('success', true)
                ->orderBy('submission_date', 'desc')->orderBy('title', 'asc')->paginate(10);
        }
        return view('funding_app/index', ['funding_apps' => $funding_apps]);
    }

    /**
     * Show the form for creating a new FundingApplication.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     *
     * @return Response The "funding_app/create" view.
     */
    public function create(FundingApplicationRequest $request)
    {
        $funders = [];
        foreach (Funder::orderby('abbreviation', 'asc')->orderby('country', 'asc')->get() as $funder) {
            $funders[$funder->id] = $funder['abbreviation'];
        }
        return view('funding_app/create', ['funders' => $funders]);
    }

    /**
     * Store a newly created FundingApplication in storage.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     *
     * @return Response Redirect to "funding_app.show" if successful or "funding_app.create" otherwise
     */
    public function store(FundingApplicationRequest $request)
    {
        $funding_app = new FundingApplication();
        $funding_app->fill($request->all());
        $funding_app->user_id = Auth::user()->id;
        $funding_app->success = $request->has('success');
        if ($request->get('submission_date') === '') {
            $funding_app->submission_date = null;
        }
        if ($request->get('amount') === '') {
            $funding_app->amount = null;
        }
        $funding_app->save();
        return redirect()->route('funding_app.show', $funding_app);
    }

    /**
     * Display the specified FundingApplication.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     * @param int                          $id      The unique identifier of the FundingApplication to show
     *
     * @return Response The "funding_app/show" view
     */
    public function show(FundingApplicationRequest $request, $id)
    {
        $funding_app = FundingApplication::findOrFail($id);
        return view('funding_app/show', ['funding_app' => $funding_app]);
    }

    /**
     * Show the form for editing the specified FundingApplication.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     * @param int                          $id      The unique identifier of the FundingApplication to edit
     *
     * @return Response The "funding_app/edit" view
     */
    public function edit(FundingApplicationRequest $request, $id)
    {
        $funding_app = FundingApplication::findOrFail($id);
        $funders = [];
        foreach (Funder::orderby('abbreviation', 'asc')->orderby('country', 'asc')->get() as $funder) {
            $funders[$funder->id] = $funder['abbreviation'];
        }
        return view('funding_app/edit', ['funding_app' => $funding_app, 'funders' => $funders]);
    }

    /**
     * Update the specified FundingApplication in storage.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     * @param int                          $id      The unique identifier of the FundingApplication to update
     *
     * @return Response Redirect to "funding_app.show" if successful or "funding_app.edit" otherwise
     */
    public function update(FundingApplicationRequest $request, $id)
    {
        $funding_app = FundingApplication::findOrFail($id);
        $funding_app->fill($request->all());
        $funding_app->success = $request->has('success');
        if ($request->get('submission_date') === '') {
            $funding_app->submission_date = null;
        }
        if ($request->get('amount') === '') {
            $funding_app->amount = null;
        }
        $funding_app->save();
        return redirect()->route('funding_app.show', $funding_app);
    }

    /**
     * Remove the specified FundingApplication from storage.
     *
     * @param FundingApplicationRequestion $request The request to use for validation and authentication
     * @param int                          $id      The unique identifier of the FundingApplication to remove
     *
     * @return Response Redirect to "funding_app.index"
     */
    public function destroy(FundingApplicationRequest $request, $id)
    {
        $funding_app = FundingApplication::findOrFail($id);
        $funding_app->applicants()->delete();
        $funding_app->delete();
        return redirect()->route('funding_app.index');
    }
    
    /**
     * Autosuggest values for FundingApplication objects.
     *
     * Generates the JSON structure needed by the jquery_autocomplete plugin. The
     * string to query must be passed in the "query" parameter and will be compared
     * case-sensitively against the "title" field.
     *
     * @param FundingApplicationRequest $request The request to use for validation and authentication.
     *
     * @return Response The JSON structure as an associative array
     */
    public function autocomplete(FundingApplicationRequest $request)
    {
        $funding_apps = FundingApplication::where('title', 'like', $request->get('query') . '%')->limit(10)->get();
        $suggestions = [];
        foreach ($funding_apps as $funding_app) {
            $suggestions[] = ['value' => $funding_app->title, 'data' => strval($funding_app->id)];
        }
        return ['suggestions' => $suggestions];
    }
}
