<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * FundingApplicant.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Auth;

use ADoc\Http\Requests\Request;
use ADoc\Models\FundingApplication;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 */
class FundingApplicantRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation is handled by checking whether the current User has access to the
     * FundingApplication that the FundingApplicant is linked to.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * FundingApplicants for their own FundingApplications and users with the necessary permissions may
     * also do so.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        $funding_app = FundingApplication::find($this->route()->getParameter('funding_app'));
        if (in_array(
            $this->route()->getName(),
            ['funding_app.applicant.create', 'funding_app.applicant.store',
                'funding_app.applicant.edit', 'funding_app.applicant.update']
        )) {
            return Auth::check() && Auth::user()->allowed('fundingapplication.edit', $funding_app);
        } elseif ($this->route()->getName() === 'funding_app.applicant.destroy') {
            return Auth::check() && Auth::user()->allowed('fundingapplication.destroy', $funding_app);
        } else {
            return false;
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
        if (in_array($this->route()->getName(), ['funding_app.applicant.store', 'funding_app.applicant.update'])) {
            return [
                    'person_id' => 'required|integer|exists:people,id',
                    'name' => 'required',
                    'role_id' => 'required|integer|exists:project_roles,id',
                    'allocation' => 'numeric'
            ];
        } else {
            return [];
        }
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * Updates the name-related rules to show nicely readable messages for the
     * person_id field.
     *
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     *
     * @return array The validation error messages.
     */
    public function messages()
    {
        return [
        'person_id.required' => 'Please select an existing person',
        'person_id.exists' => 'Please select an existing person'
        ];
    }
}
