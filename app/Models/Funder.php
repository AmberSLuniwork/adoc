<?php
/**
 * Contains the Funder model.
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
 * The Funder model represents a funding body.
 *
 * It contains the following fields:
 *
 * * name - The name of the funding boddy
 * * abbreviation - Abbreviated name of the funding body
 * * country - The country the funding body is based in
 */
class Funder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'abbreviation', 'country'];
}
