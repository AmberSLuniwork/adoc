<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * QualificationAward.
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
use ADoc\Models\Person;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 *
 * @package ADoc\Http\Requests
 */
class QualificationAwardRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation is handled by checking whether the current User has access to the
     * Person that the QualificaitonAward is linked to.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * QualificationAwards for their own Persons and users with the necessary permissions may
     * also do so.
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        $person = Person::find($this->route()->getParameter('person'));
        if (in_array(
            $this->route()->getName(),
            ['person.award.create', 'person.award.store',
                'person.award.edit', 'person.award.update']
        )) {
            return Auth::check() && Auth::user()->allowed('person.edit', $person);
        } elseif ($this->route()->getName() === 'person.award.destroy') {
            return Auth::check() && Auth::user()->allowed('person.destroy', $person);
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
        if (in_array($this->route()->getName(), ['person.award.store', 'person.award.update'])) {
            return [
            'qualification_id' => 'required|integer|exists:qualifications,id',
            'year' => 'required|integer|min:0'
            ];
        } else {
            return [];
        }
    }
}
