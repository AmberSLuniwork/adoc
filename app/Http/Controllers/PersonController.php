<?php
/**
 * Controller for the Person.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Auth;

use ADoc\Http\Requests\PersonRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\Person;

/**
 * The PersonController provides the functionality for listing, showing, creating,
 * updating and deleting Persons.
 *
 * @package ADoc\Http\Controllers
 */
class PersonController extends Controller
{
    /**
     * Display a paginatable listing of Persons.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     *
     * @return Response The "person/index" view.
     */
    public function index(PersonRequest $request)
    {
        if (Auth::check() && Auth::user()->can('person.view')) {
            $people = Person::orderBy('lastname', 'asc')->orderBy('firstname', 'asc')->paginate(10);
        } elseif (Auth::check()) {
            $people = Person::where('status', 'public')->orWhere('user_id', Auth::user()->id)
                ->orderBy('lastname', 'asc')->orderBy('firstname', 'asc')->paginate(10);
        } else {
            $people = Person::where('status', 'public')->orderBy('lastname', 'asc')
                ->orderBy('firstname', 'asc')->paginate(10);
        }
        return view('person/index', ['people' => $people]);
    }

    /**
     * Show the form for creating a new Person.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     *
     * @return Response The "person/create" view.
     */
    public function create(PersonRequest $request)
    {
        return view('person/create');
    }

    /**
     * Store a newly created Person in storage.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     *
     * @return Response Redirect to "person.show" if successful or "pseron.create" otherwise
     */
    public function store(PersonRequest $request)
    {
        $person = new Person();
        $person->fill($request->all());
        $person->user_id = Auth::user()->id;
        $person->save();
        return redirect()->route('person.show', [$person]);
    }

    /**
     * Display the specified Person.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     * @param int           $id      The unique identifier of the Person to show
     *
     * @return Response The "person/show" view
     */
    public function show(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        return view('person/show', ['person' => $person]);
    }

    /**
     * Show the form for editing the specified Person.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     * @param int           $id      The unique identifier of the Person to edit
     *
     * @return Response The "person/edit" view
     */
    public function edit(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        return view('person/edit', ['person' => $person]);
    }

    /**
     * Update the specified Person in storage.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     * @param int           $id      The unique identifier of the Person to update
     *
     * @return Response Redirect to "person.show" if successful or "person.edit" otherwise.
     */
    public function update(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->fill($request->all());
        $person->save();
        return redirect()->route('person.show', [$person]);
    }

    /**
     * Remove the specified Person from storage.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     * @param int           $id      The unique identifier of the Person to remove
     *
     * @return Response Redirect to "person.index"
     */
    public function destroy(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->awards()->delete();
        $person->delete();
        return redirect()->route('person.index');
    }
    
    /**
     * Autosuggest values for Person objects.
     *
     * Generates the JSON structure needed by the jquery_autocomplete plugin. The
     * string to query must be passed in the "query" parameter and will be compared
     * case-sensitively against the "firstname" and "lastname" fields.
     *
     * @param PersonRequest $request The request to use for validation and authentication.
     *
     * @return Response The JSON structure as an associative array
     */
    public function autocomplete(PersonRequest $request)
    {
        $people = Person::where('firstname', 'like', $request->get('query') . '%')
            ->orWhere('lastname', 'like', $request->get('query') . '%')->limit(10)->get();
        $suggestions = [];
        foreach ($people as $person) {
            $suggestions[] = ['value' => $person->fullName(), 'data' => strval($person->id)];
        }
        return ['suggestions' => $suggestions];
    }
}
