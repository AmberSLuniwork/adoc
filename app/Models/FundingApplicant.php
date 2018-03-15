<?php
/**
 * Contains the FundingApplicant model.
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
 * The FundingApplicant model links Person to FundingApplication.
 *
 * It contains the following fields:
 *
 * * person_id - To link to the Person
 * * funding_application_id - To link to the FundingApplication
 * * role_id - To link to the ProjectRole
 * * allocation - The fractional amount of working time allocated to the FundingApplication
 */
class FundingApplicant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['person_id', 'role_id', 'allocation'];
    
    public $name = '';

    /**
     * Retrieves the linked Person.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed
     */
    public function person()
    {
        return $this->belongsTo('ADoc\Models\Person')->getResults();
    }
    
    /**
     * Retrieves the linked ProjectRole.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed
     */
    public function role()
    {
        return $this->belongsTo('ADoc\Models\ProjectRole')->getResults();
    }
    
    /**
     * Retrieves the linked FundingApplication.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed
     */
    public function fundingApplication()
    {
        return $this->belongsTo('ADoc\Models\FundingApplication')->getResults();
    }
}
