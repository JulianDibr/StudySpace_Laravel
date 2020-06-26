<?php

namespace App;

use Carbon\Carbon;
use Demency\Friendships\Traits\Friendable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function postings()
    {
        return $this->hasMany('App\Posting');
    }

    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group');
    }

    public function getUserImage()
    {
        return asset('storage/profile_pictures/users/' . $this->profile_picture);
    }

    public function getBirthdayAttribute($date)
    {
        if ($date !== null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
        }
        return null;
    }

    public function getAllNonFriends()
    {
        $currentUser = Auth::user();
        $allUsers = User::where('id', '!=', $currentUser->id)->inRandomOrder()->get();
        $diffUserFriends = $allUsers->diff($currentUser->getFriends());
        $receivedRequests = $diffUserFriends->diff($currentUser->getFriendRequests()->pluck('sender'));
        return $receivedRequests->diff($currentUser->getPendingFriendships()->pluck('recipient'));
    }
}
