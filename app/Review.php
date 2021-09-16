<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name', 'lastname', 'body', 'title', 'vote'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
