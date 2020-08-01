<?php

namespace App;

use App\Helpers\commonHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model {
    protected $fillable = ['name', 'description', 'image', 'admin_id', 'user_invite', 'deadline', 'is_open'];
    protected $dates = ['deadline'];

    public function users() {
        return $this->belongsToMany('App\User')->withPivot('status');
    }

    public function admin() {
        return $this->belongsTo('App\User');
    }

    public function postings() {
        return $this->hasMany('App\Posting');
    }

    public function getProjectImage() {
        if ($this->image) {
            return asset('storage/profile_pictures/projects/' . $this->image);
        } else {
            return asset('storage/profile_pictures/projects/default.jpg');
        }
    }

    public function checkUserStatus() {
        return commonHelpers::checkInvitationStatus($this);
    }
}
