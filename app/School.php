<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function getSchoolImage()
    {
        return asset('storage/profile_pictures/schools/' . $this->profile_picture);
    }
}
