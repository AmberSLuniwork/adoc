<?php
/**
 * Contains the FundingApplication model.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Models
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Models;

use ADoc\Models\FundingApplicant;
use Illuminate\Database\Eloquent\Model;

/**
 * The FundingApplication model represents an application for funding to a Funder
 *
 * It contains the following fields:
 *
 * * user_id - The id of the User who owns this FundingApplication
 * * title - Title of this FundingApplication
 * * funder_id - The id of the Funder that the FundingApplication was made to
 * * scheme - Description of the specific funding scheme
 * * amount - Amount of money applied for
 * * currency - Currency for the amount
 * * submission_date - The date of submission for this FundingApplication
 * * summary - A longer textual summary of the FundingApplication's goals
 * * stage - The current stage of the FundingApplication (preparation/review/decision)
 * * success - Whether the FundingApplication has been successful
 * * status - Status public or private to restrict access
 */
class FundingApplication extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'title',
            'funder_id',
            'scheme',
            'amount',
            'currency',
            'submission_date',
            'summary',
            'stage',
            'success',
            'status'
    ];
    
    /**
     * Returns the Funder that this FundingApplication is linked to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed
     */
    public function funder()
    {
        return $this->belongsTo('ADoc\Models\Funder')->getResults();
    }
    
    /**
     * Returns all FundingApplications that are linked to this FundingApplication.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applicants()
    {
        return $this->hasMany('ADoc\Models\FundingApplicant');
    }

    /**
     * Returns all ProjectFundings that are linked to this FundingApplication.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fundings()
    {
        return $this->hasMany('ADoc\Models\ProjectFunding');
    }
}
