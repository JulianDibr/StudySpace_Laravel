<?php

namespace App;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Traits\Messagable;
use Demency\Friendships\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable {
    use Notifiable;
    use Friendable;
    use Messagable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function postings() {
        return $this->hasMany('App\Posting');
    }

    public function school() {
        return $this->belongsTo('App\School');
    }

    public function courses() {
        return $this->belongsToMany('App\Course');
    }

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function projects() {
        return $this->belongsToMany('App\Project');
    }

    public function settings() {

    }

    public function getUserImage() {
        if ($this->profile_picture) {
            return asset('storage/profile_pictures/users/' . $this->profile_picture);
        } else {
            return asset('storage/profile_pictures/users/default.png');
        }
    }

    public function getBirthdayAttribute($date) {
        if ($date !== null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
        }
        return null;
    }

    public function todayBirthday() {
        if($this->birthday !== null) {
            return Carbon::now()->isBirthday($this->birthday);
        }
        return false;
    }

    public function getFullName() {
        return $this->first_name . " " . $this->last_name;
    }

    public function getAllNonFriends() {
        $currentUser = Auth::user();
        $allUsers = User::where('id', '!=', $currentUser->id)->inRandomOrder()->get();
        $diffUserFriends = $allUsers->diff($currentUser->getFriends());
        $receivedRequests = $diffUserFriends->diff($currentUser->getFriendRequests()->pluck('sender'));
        return $receivedRequests->diff($currentUser->getPendingFriendships()->pluck('recipient'));
    }

    public function getRecommendedCourses() {
        $schoolCourses = $this->school->courses;
        if ($schoolCourses !== null) {
            return $schoolCourses->diff($this->courses);
        } else {
            return [];
        }
    }

    public function getRecommendedGroups() {
        $allGroups = $this->school->groups;
        if ($allGroups !== null) {
            return $allGroups->diff($this->groups);
        } else {
            return [];
        }
    }

    public function getRecommendedProjects() {
        $allProjects = Project::all();
        if ($allProjects !== null) {
            return $allProjects->diff($this->projects);
        } else {
            return [];
        }
    }

    public function getConversations() {
        return Thread::forUser(Auth::id())->latest('updated_at')->get();
    }
}
