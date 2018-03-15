<?php
/**
 * Contains the ProjectFunding model.
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
 * The ProjectFunding model links Project to FundingApplication.
 *
 * It contains the following fields:
 *
 * * project_id - To link to the Project
 * * funding_application_id - To link to the FundingApplication
 * * amount - The funded amount
 * * currency - The funding currency
 */
class ProjectFunding extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['funding_application_id', 'amount', 'currency'];
    
    public $name = '';

    /**
     * Retrieves the linked Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed
     */
    public function project()
    {
        return $this->belongsTo('ADoc\Models\Project')->getResults();
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
