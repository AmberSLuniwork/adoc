<?php
/**
 * Contains the Project model.
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
 * The Project model represents a project.
 *
 * It contains the following fields:
 *
 * * user_id - The id of the User who owns this Project
 * * title - Title of this Project
 * * acronym - Acronym of this Project (optional)
 * * summary - A longer textual summary of the Project
 * * start - The start date for this Project
 * * end - The end date for this Project
 * * stage - The current stage of the Project (planning/active/inactive/complete)
 * * status - Status public or private to restrict access
 */
class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'title',
            'acronym',
            'summary',
            'start',
            'end',
            'stage',
            'status'
    ];

    /**
     * Returns all ProjectParticipants that are linked to this Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('ADoc\Models\ProjectParticipant');
    }
    
    /**
     * Returns all ProjectFundings that are linked to this Project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fundings()
    {
        return $this->hasMany('ADoc\Models\ProjectFunding');
    }
}
