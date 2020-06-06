<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_1', 'user_2');
    }

    public function getUserImage()
    {
        return asset('storage/profile_pictures/' . $this->profile_picture);
    }
}
