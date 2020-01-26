<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the challenges for the category.
     */
    public function challenges()
    {
        return $this->hasMany('App\Models\Challenge');
    }
}
