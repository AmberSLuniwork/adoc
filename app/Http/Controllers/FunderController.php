<?php
/**
 * Controller for the Funder.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers;

use Illuminate\Http\Request;

use ADoc\Http\Requests\FunderRequest;
use ADoc\Http\Controllers\Controller;
use ADoc\Models\Funder;

/**
 * The FunderController provides the functionality for listing, showing, creating,
 * updating and deleting Funders.
 *
 * @package ADoc\Http\Controllers
 */
class FunderController extends Controller
{
    /**
     * Display a paginatable listing of Funders.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     *
     * @return Response The "funder/index" view.
     */
    public function index(FunderRequest $request)
    {
        $funders = Funder::orderby('name', 'asc')->paginate(30);
        return view('funder/index', ['funders' => $funders]);
    }

    /**
     * Show the form for creating a new Funder.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     *
     * @return Response The "funder/create" view.
     */
    public function create(FunderRequest $request)
    {
        return view('funder/create');
    }

    /**
     * Store a newly created Funder in storage.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     *
     * @return Response Redirect to "funder.show" if successful and "funder.create" if not
     */
    public function store(FunderRequest $request)
    {
        $funder = new Funder();
        $funder->fill($request->all());
        $funder->save();
        return redirect()->route('funder.show', $funder);
    }

    /**
     * Display the specified Funder.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     * @param int           $id      The unique identifier of the Funder to show
     *
     * @return Response The "funder/show" view.
     */
    public function show(FunderRequest $request, $id)
    {
        $funder = Funder::findOrFail($id);
        return view('funder/show', ['funder' => $funder]);
    }

    /**
     * Show the form for editing the specified Funder.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     * @param int           $id      The unique identifier of the Funder to edit
     *
     * @return Response The "funder/edit" view.
     */
    public function edit(FunderRequest $request, $id)
    {
        $funder = Funder::findOrFail($id);
        return view('funder/edit', ['funder' => $funder]);
    }

    /**
     * Update the specified Funder in storage.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     * @param int           $id      The unique identifier of the Funder to update
     *
     * @return Response Redirect to "funder.show" if successful or "funder.edit" otherwise.
     */
    public function update(FunderRequest $request, $id)
    {
        $funder = Funder::findOrFail($id);
        $funder->fill($request->all());
        $funder->save();
        return redirect()->route('funder.show', $funder);
    }

    /**
     * Remove the specified Funder from storage.
     *
     * @param FunderRequest $request The request to use for validation and authentication
     * @param int           $id      The unique identifier of the Funder to remove
     *
     * @return Response Redirect to "funder.index".
     */
    public function destroy(FunderRequest $request, $id)
    {
        $funder = Funder::findOrFail($id);
        $funder->delete();
        return redirect()->route('funder.index');
    }
}
