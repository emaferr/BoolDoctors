<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Specialization extends Model
{
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
