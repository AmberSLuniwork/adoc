<?php
/**
 * Post-authentication redirection middleware.
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
 * Middleware that redirects the user if they are already authenticated.
 *
 * This middleware works together with the Authenticate middleware to redirect
 * the unauthenticated user to the login and then back to the page they wanted
 * to access.
 *
 * @package ADoc\Http\Middleware
 */
class RedirectIfAuthenticated
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
     * @param Guard $auth The guard to use to check authentication
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
        if ($this->auth->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
