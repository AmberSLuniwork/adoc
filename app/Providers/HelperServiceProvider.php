<?php
/**
 * Contains the HelperServiceProvider.
 *
 * PHP Version 5
 *
 * @package ADoc\Providers
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Providers;

use Illuminate\Support\ServiceProvider;

use ADoc\Helpers\UIHelper;

/**
 * The HelperServiceProvider acts as the service provider that registers all
 * view helpers.
 */
class HelperServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            'ui',
            function () {
                return new UIHelper();
            }
        );
    }
}
