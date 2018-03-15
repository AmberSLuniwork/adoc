<?php
/**
 * Controller for the QualificationAward.
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
use ADoc\Http\Requests\QualificationAwardRequest;
use ADoc\Models\Person;
use ADoc\Models\Qualification;
use ADoc\Models\QualificationAward;

/**
 * The QualificationAwardController provides the functionality for adding and
 * removing Qualification from Person.
 *
 * Only the create/update/delete endpoints are implemented. All other endpoints
 * redirect to the appropriate endpoint in the PersonController.
 *
 * @package ADoc\Http\Controllers
 */
class QualificationAwardController extends Controller
{
    /**
     * Redirect to the "person.show" route.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person to redirect to
     *
     * @return Response Redirection response
     */
    public function index(QualificationAwardRequest $request, $pid)
    {
        return redirect()->route('person.show', $pid);
    }

    /**
     * Show the form for creating a new QualificationAward.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person to add the QualificationAward to
     *
     * @return Response The "person/award/create" view.
     */
    public function create(QualificationAwardRequest $request, $pid)
    {
        $person = Person::findOrFail($pid);
        $qualifications = [];
        foreach (Qualification::orderBy('long', 'asc')->get() as $qualification) {
            $qualifications[$qualification->id] = $qualification->long;
        }
        return view('person/award/create', ['person' => $person, 'qualifications' => $qualifications]);
    }

    /**
     * Store a newly created QualificationAward in storage.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person to add the QualificationAward to
     *
     * @return Response Redirection to "person.show" or "person.create" on a
     * request that does not fulfil the QualificationAwardRequest criteria.
     */
    public function store(QualificationAwardRequest $request, $pid)
    {
        $person = Person::findOrFail($pid);
        $award = new QualificationAward();
        $award->fill($request->all());
        $award->person_id = $pid;
        $award->save();
        return redirect()->route('person.show', $pid);
    }

    /**
     * Redirect to the "person.show" route.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person to redirect to
     * @param Integer                   $aid     The id of the QualificationAward
     *
     * @return Response Redirection response
     */
    public function show(QualificationAwardRequest $request, $pid, $aid)
    {
        return redirect()->route('person.show', $pid);
    }

    /**
     * Show the form for editing the QualificationAward.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person that the QualificationAward belongs to
     * @param Integer                   $aid     The id of the QualificationAward to edit
     *
     * @return Response The "person/award/edit" view.
     */
    public function edit(QualificationAwardRequest $request, $pid, $aid)
    {
        $person = Person::findOrFail($pid);
        $award = QualificationAward::where('id', $aid)->where('person_id', $pid)->firstOrFail();
        $qualifications = [];
        foreach (Qualification::orderBy('long', 'asc')->get() as $qualification) {
            $qualifications[$qualification->id] = $qualification->long;
        }
        return view('person.award.edit', ['person' => $person, 'award' => $award, 'qualifications' => $qualifications]);
    }

    /**
     * Update the QualificationAward in storage.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person that the QualificationAward belongs to
     * @param Integer                   $aid     The id of the QualificationAward to update
     *
     * @return Response Redirection to "person.show" on success or "person.award.edit" on an
     * invalid request.
     */
    public function update(QualificationAwardRequest $request, $pid, $aid)
    {
        $person = Person::findOrFail($pid);
        $award = QualificationAward::where('id', $aid)->where('person_id', $pid)->firstOrFail();
        $award->fill($request->all());
        $award->save();
        return redirect()->route('person.show', $person);
    }

    /**
     * Remove the QualificationAward from storage.
     *
     * @param QualificationAwardRequest $request The request to use for validation
     * @param Integer                   $pid     The id of the Person that the QualificationAward belongs to
     * @param Integer                   $aid     The id of the QualificationAward to delete
     *
     * @return Response Redirection to "person.show".
     */
    public function destroy(QualificationAwardRequest $request, $pid, $aid)
    {
        $person = Person::findOrFail($pid);
        $award = QualificationAward::where('id', $aid)->where('person_id', $pid)->firstOrFail();
        $award->delete();
        return redirect()->route('person.show', $person);
    }
}
