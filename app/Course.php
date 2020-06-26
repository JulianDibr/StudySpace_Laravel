<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
    {
        $this->hasMany('App\User');
    }

    public function admin(){
        $this->belongsTo('App\User');
    }

    public function postings() {
        $this->hasMany('App\Posting');
    }
}
