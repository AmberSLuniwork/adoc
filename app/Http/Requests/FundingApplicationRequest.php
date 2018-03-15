<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * FundingApplication.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Auth;
use Route;

use ADoc\Http\Requests\Request;
use ADoc\Models\FundingApplication;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 *
 * @package ADoc\Http\Requests
 */
class FundingApplicationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * their own FundingApplications, users with the necessary permissions may also do so,
     * and other users may only view FundingApplications that are set as "public".
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array(
            $this->route()->getName(),
            [
                'funding_app.create',
                'funding_app.store',
                'funding_app.autocomplete'
            ]
        )) {
                return Auth::check() && Auth::user()->can('fundingapplication.create');
        } elseif (in_array($this->route()->getName(), ['funding_app.edit', 'funding_app.update'])) {
            $application = FundingApplication::find($this->route()->getParameter('funding_app'));
            return Auth::check() && Auth::user()->allowed('fundingapplication.edit', $application);
        } elseif ($this->route()->getName() === 'funding_app.destroy') {
            $application = FundingApplication::find($this->route()->getParameter('funding_app'));
            return Auth::check() && Auth::user()->allowed('fundingapplication.destroy', $application);
        } elseif ($this->route()->getName() === 'funding_app.show') {
            $application = FundingApplication::find($this->route()->getParameter('funding_app'));
            if (Auth::check() && Auth::user()->allowed('fundingapplication.view', $application)) {
                return true;
            } else {
                if ($application && $application->status === 'public') {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Validation rules are only created for the "store" and "update" routes.
     *
     * @return array The validation rules as an associative array
     */
    public function rules()
    {
        if (in_array(Route::currentRouteName(), ['funding_app.store', 'funding_app.update'])) {
            return [
            'title' => 'required|max:255',
            'funder_id' => 'required|exists:funders,id',
            'scheme' => '',
            'amount' => 'numeric',
            'submission_date' => 'date_format:Y-m-d',
            'summary' => '',
            'stage' => 'in:preparation,review,decision',
            'success' => 'boolean',
            'status' => 'required|in:private,public'
            ];
        } else {
            return [];
        }
    }
}
