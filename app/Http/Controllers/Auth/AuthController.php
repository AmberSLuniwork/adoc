<?php
/**
 * Contains the AuthController provided by Laravel.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Controllers\Auth
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Controllers\Auth;

use ADoc\Models\User;
use Validator;
use ADoc\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * The AuthController handles the registration of new users together with the
 * authentication of existing users. It does this by including the
 * AuthenticatesAndRegistersUsers trait.
 *
 * @package ADoc\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;
    
    /**
     * Redirect to the root path.
     */
    protected $redirectPath = '/';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data The new user data to validate
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data The data to use to create the new User.
     *
     * @return User The newly created User.
     */
    protected function create(array $data)
    {
        return User::create(
            [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            ]
        );
    }
}
