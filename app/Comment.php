<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function posting() {
        return $this->belongsTo('App\Posting');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
