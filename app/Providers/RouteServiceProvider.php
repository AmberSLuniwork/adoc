<?php
/**
 * Contains the RouteServiceProvider.
 *
 * PHP Version 5
 *
 * @package ADoc\Providers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

/**
 * The RouteServiceProvider provides the helper functionality for dealing with
 * routes in the application and views.
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'ADoc\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router The router to use for routing
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router The router to use for routing
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(
            ['namespace' => $this->namespace],
            function ($router) {
                include app_path('Http/routes.php');
            }
        );
    }
}
