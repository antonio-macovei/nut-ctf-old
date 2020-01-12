<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'token'
    ];
    
    /**
     * Get the users who are members of the team.
     */
    public function users()
    {
         return $this->hasMany('App\User');
    }
}
