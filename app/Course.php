<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function admin(){
        return $this->belongsTo('App\User');
    }

    public function postings() {
        return $this->hasMany('App\Posting');
    }

    public function getCourseImage() {
        if($this->image) {
            return asset('storage/profile_pictures/courses/' . $this->image);
        } else {
            return asset('storage/profile_pictures/courses/default.png');
        }
    }
}
