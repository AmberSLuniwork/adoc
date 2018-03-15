<?php
/**
 * Contains the Request extension to authorise and validate requests related to the
 * Person.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Requests
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Requests;

use Auth;
use Input;
use Route;

use ADoc\Http\Requests\Request;
use ADoc\Models\Person;

/**
 * Defines the authorize() and rules() methods that provide the authorisation and
 * validation rules used.
 *
 * @package ADoc\Http\Requests
 */
class PersonRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Authorisation rules follow the standard pattern that any user may view/edit/delete
     * their own Persons, users with the necessary permissions may also do so,
     * and other users may only view Persons that are set as "public".
     *
     * @return bool Whether the current User is authorised for the route (true) or not (false)
     */
    public function authorize()
    {
        if (in_array($this->route()->getName(), ['person.create', 'person.store', 'person.autocomplete'])) {
            return Auth::check() && Auth::user()->can('person.create');
        } elseif (in_array($this->route()->getName(), ['person.edit', 'person.update'])) {
            $person = Person::find($this->route()->getParameter('person'));
            return Auth::check() && Auth::user()->allowed('person.edit', $person);
        } elseif ($this->route()->getName() === 'person.destroy') {
            $person = Person::find($this->route()->getParameter('person'));
            return Auth::check() && Auth::user()->allowed('person.destroy', $person);
        } elseif ($this->route()->getName() === 'person.show') {
            $person = Person::find($this->route()->getParameter('person'));
            if (Auth::check() && Auth::user()->allowed('person.view', $person)) {
                return true;
            } else {
                if ($person && $person->status === 'public') {
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
        if (in_array(Route::currentRouteName(), ['person.store', 'person.update'])) {
            return [
            'firstname' => 'required|max:255',
            'middlename' => 'max:255',
            'lastname' => 'required|max:255',
            'status' => 'required|in:private,public'
            ];
        } else {
            return [];
        }
    }
    
    /**
     * Get the validation error messages that apply to the request.
     *
     * Updates the name-related rules to show nicely readable messages for the
     * multi-word fields.
     *
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     *
     * @return array The validation error messages.
     */
    public function messages()
    {
        return [
        'firstname.required' => 'The first name field is required',
        'firstname.max' => 'The first name cannot be longer than 255 characters',
        'middlename.max' => 'The middle name cannot be longer than 255 characters',
        'lastname.required' => 'The last name field is required',
        'lastname.max' => 'The last name cannot be longer than 255 characters'
        ];
    }
}
