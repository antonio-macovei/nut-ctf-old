<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the user who created a submission.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the team who created a submission.
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }

     /**
     * Get the challenge for which the submission is.
     */
    public function challenge()
    {
        return $this->belongsTo('App\Models\Challenge', 'challenge_id');
    }
}
