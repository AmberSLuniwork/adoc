<?php
/**
 * Contains the ProjectRole model.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Models
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * The ProjectRole model represents a role that a Person can take in a Project or FundingApplication.
 *
 * It contains the following fields:
 *
 * * long - The long name of the ProjectRole
 * * short - The short abbreviation of the ProjectRole
 */
class ProjectRole extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['long', 'short'];
}
