<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $fillable = ['user_id', 'posting_id', 'is_upvote'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function posting() {
        return $this->belongsTo('App\Posting');
    }
}
