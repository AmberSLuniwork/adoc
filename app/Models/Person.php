<?php
/**
 * Contains the Person model.
 *
 * PHP Version 5
 *
 * @package ADoc\Http\Models
 * @author  Mark Hall <Mark.Hall@edgehill.ac.uk>
 * @license https://gnu.org/licenses/agpl.html GNU Affero General Public License
 */

namespace ADoc\Models;

use Illuminate\Database\Eloquent\Model;

use ADoc\Models\Qualification;

/**
 * The Person model represents a single person.
 *
 * It contains the following fields:
 *
 * * user_id - The id of the User who owns this Person
 * * firstname - The Person's first name
 * * middlename - The Person's middle name (optional)
 * * lastname - The Person's last name
 * * status - Status public or private to restrict access
 */
class Person extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'middlename', 'lastname', 'status'];
    
    /**
     * Returns the Person's Qualifications ordered for placement before or
     * after the name.
     *
     * The Qualifications are retrieved via the QualificationAwards and can optionally
     * be filtered to those place before the name and those after via the position
     * parameter.
     *
     * @param string $position The position for which to return titles (before/after/empty)
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed The linked Qualifications
     */
    public function titles($position)
    {
        $qualifications = Qualification::join(
            'qualification_awards',
            'qualifications.id',
            '=',
            'qualification_awards.qualification_id'
        )->where('qualification_awards.person_id', $this->id);
        if ($position == 'before' || $position == 'after') {
            $qualifications = $qualifications->where('qualifications.position', $position)
                ->orderby('qualifications.weight', 'asc');
        } else {
            $qualifications = $qualifications->orderby('qualifications.position', 'desc')
                ->orderby('qualifications.weight', 'asc');
        }
        $titles = [];
        foreach ($qualifications->get() as $qualification) {
            $titles[] = $qualification->short;
        }
        if ($position == 'before') {
            $titles = implode(' ', $titles) . ' ';
        } else {
            $titles = implode(', ', $titles) . ' ';
        }
           return $titles;
    }
    
    /**
     * Returns a string representation of the Person's first, middle, and last name.
     *
     *  The middle name(s) are abbreviated and fashioned with full-stops.
     *
     * @return string The Person's full name.
     */
    public function fullName()
    {
        $fullname = '';
        $fullname = $fullname . $this->firstname;
        if ($this->middlename != '') {
            $fullname = $fullname . ' ' . implode(
                '.',
                array_map(
                    function ($part) {
                        return substr($part, 0, 1);
                    },
                    explode(' ', $this->middlename)
                )
            ) . '.';
        }
        $fullname = $fullname . ' ' . $this->lastname;
        return $fullname;
    }
    
    /**
     * Returns the linked QualificationAwards ordered by year.
     *
     * @return \Illuminate\Database\Eloquent\Relations\mixed The linked QualificationAwards
     */
    public function awards()
    {
        return $this->hasMany('ADoc\Models\QualificationAward')->orderBy('year', 'desc');
    }
    
    /**
     * Returns the linked FundingApplicants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The linked FundingApplicants
     */
    public function applications()
    {
        return $this->hasMany('ADoc\Models\FundingApplicant');
    }
    
    /**
     * Returns the linked ProjectParticipants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany The linked ProjectParticipants
     */
    public function projects()
    {
        return $this->hasMany('ADoc\Models\ProjectParticipant');
    }
}
