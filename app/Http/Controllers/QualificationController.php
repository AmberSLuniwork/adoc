<?php
/**
 * Controller for the Qualification.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Illuminate\Http\Request;

use ADoc\Http\Requests\QualificationRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\Qualification;

/**
 * The QualificationController provides the functionality for listing, showing, creating,
 * updating and deleting Qualifications.
 *
 * @package ADoc\Http\Controllers
 */
class QualificationController extends Controller
{
    /**
     * Display a paginatable listing of Qualifications.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     *
     * @return Response The "qualification/index" view.
     */
    public function index(QualificationRequest $request)
    {
        $qualifications = Qualification::orderBy('position', 'asc')->orderBy('weight', 'asc')->paginate(30);
        return view('qualification/index', ['qualifications' => $qualifications]);
    }

    /**
     * Show the form for creating a new Qualification.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     *
     * @return Response The "qualification/create" view.
     */
    public function create(QualificationRequest $request)
    {
        return view('qualification/create');
    }

    /**
     * Store a newly created Qualification in storage.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     *
     * @return Response Redirect to "qualification.show" on success or "qualification.create" otherwise
     */
    public function store(QualificationRequest $request)
    {
        $qualification = new Qualification();
        $qualification->fill($request->all());
        $qualification->save();
        return redirect()->route('qualification.show', [$qualification]);
    }

    /**
     * Display the specified Qualification.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     * @param int                  $id      The unique identifier of the Qualification to show
     *
     * @return Response The "qualification/show" view
     */
    public function show(QualificationRequest $request, $id)
    {
        $qualification = Qualification::findOrFail($id);
        return view('qualification/show', ['qualification' => $qualification]);
    }

    /**
     * Show the form for editing the specified Qualification.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     * @param int                  $id      The unique identifier of the Qualification to edit
     *
     * @return Response The "qualification/edit" view
     */
    public function edit(QualificationRequest $request, $id)
    {
        $qualification = Qualification::findOrFail($id);
        return view('qualification/edit', ['qualification' => $qualification]);
    }

    /**
     * Update the specified Qualification in storage.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     * @param int                  $id      The unique identifier of the Qualification to update
     *
     * @return Response Redirect to "qualification.show" on success or "qualification.edit" otherwise
     */
    public function update(QualificationRequest $request, $id)
    {
        $qualification = Qualification::findOrFail($id);
        $qualification->fill($request->all());
        $qualification->save();
        return redirect()->route('qualification.show', ['qualification' => $qualification]);
    }

    /**
     * Remove the specified Qualification from storage.
     *
     * @param QualificationRequest $request The request to use for validation and authentication
     * @param int                  $id      The unique identifier of the Qualification to remove
     *
     * @return Response Redirect to "qualification.index"
     */
    public function destroy(QualificationRequest $request, $id)
    {
        $qualification = Qualification::findOrFail($id);
        $qualification->delete();
        return redirect()->route('qualification.index');
    }
}
