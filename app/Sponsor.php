<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    protected $fillable = [
        'name', 'duration', 'price'
    ];

    public function user()
    {
        return $this->belongsToMany('App\User')->withPivot('expiration_time')->withTimestamps();
    }
}
