<?php
/**
 * Class for integrating application commands into Artisan
 *
 * PHP Version 5
 *
 * @package ADoc\Console
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Integrate application commands into Artisan.
 *
 * Extends the ConsoleKernel to load any application-specific command-line functions
 * into the Artisan command-line.
 *
 * @package ADoc\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule The scheduling
     * controller to use for running regular commands
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    }
}
