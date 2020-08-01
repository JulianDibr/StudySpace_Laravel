<?php

namespace App;

use App\Helpers\commonHelpers;
use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    protected $fillable = ['name', 'abbreviation', 'description', 'teacher', 'image', 'admin_id', 'school_id', 'user_invite'];

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function admin() {
        return $this->belongsTo('App\User');
    }

    public function postings() {
        return $this->hasMany('App\Posting');
    }

    public function getCourseImage() {
        if ($this->image) {
            return asset('storage/profile_pictures/courses/' . $this->image);
        } else {
            return asset('storage/profile_pictures/courses/default.jpg');
        }
    }

    public function checkUserStatus() {
        return commonHelpers::checkInvitationStatus($this);
    }
}
