<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    /**
     * Get the category of the challenge.
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    /**
     * Get the submissions for the challenge.
     */
    public function submissions()
    {
        return $this->hasMany('App\Models\Submission');
    }
}
