<?php
/**
 * Contains the QualificationAward model.
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
 * The QualificationAward model links Person to Qualification.
 *
 * It contains the following fields:
 *
 * * person_id - To link to the Person
 * * qualification_id - To link to the Qualification
 * * year - The year the Qualification was awarded
 */
class QualificationAward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['qualification_id', 'year'];
    
    /**
     * The Qualification that this QualificationAward belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed The linked Qualification
     */
    public function qualification()
    {
        return $this->belongsTo('ADoc\Models\Qualification')->getResults();
    }
}
