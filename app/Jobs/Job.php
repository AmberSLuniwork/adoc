<?php
/**
 * Queueable Job handling core.
 *
 * PHP Version 5
 *
 * @package ADoc\Events
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Jobs;

use Illuminate\Bus\Queueable;

/**
 * The Job class provides the abstract base class for defining queueable Jobs
 * and provides generic functionality for those.
 */
abstract class Job
{

    use Queueable;
}
