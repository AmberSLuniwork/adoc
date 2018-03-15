<?php
/**
 * Contains the Qualification model.
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
 * The Qualification model represents a qualification that can be linked to a Person.
 *
 * It contains the following fields:
 *
 * * long - The long description of this Qualification
 * * short - To short description of this Qualification
 * * position - The position of this Qualification relative to the name (before/after)
 * * weight - The weight of this Qualification used for ordering them
 */
class Qualification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['long', 'short', 'position', 'weight'];
}
