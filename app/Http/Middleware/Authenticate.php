<?php
/**
 * Authentication middleware.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Middleware
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * The Authenticate middleware handles redirection on unauthenticated requests
 * that require authentication.
 *
 * @package ADoc\Http\Middleware
 */
class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth The authentication guard to use.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request The current request
     * @param \Closure                 $next    The next handler in the request chain
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }

        return $next($request);
    }
}
