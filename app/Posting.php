<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Posting extends Model
{
    protected $fillable = ['user_id', 'content', 'location_type', 'location_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function votings()
    {
        return $this->hasMany('App\Voting');
    }

    public function getByUser($id)
    {
        return Posting::with('user')->where('user_id', $id)->get()->sortByDesc('updated_at');
    }

    public function getVoting()
    {
        return count($this->votings->where('is_upvote', true)) - count($this->votings->where('is_upvote', false));
    }

    public function getIsUpvoted()
    {
        return $this->votings->where('is_upvote', true)->contains('user_id', Auth::user()->id);
    }

    public function getIsDownvoted()
    {
        return $this->votings->where('is_upvote', false)->contains('user_id', Auth::user()->id);
    }

    public function ownPosting()
    {
        return $this->user_id === Auth::user()->id;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y, H:i');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y, H:i');
    }

    public function getFeed()
    {
        $user = Auth::user();

        return Posting::with('user')->get()->sortByDesc('updated_at');
    }

    public function getLocationRoute()
    {
        switch ($this->location_type) {
            case 0:
                return route('home');
            case 1:
                return url('profile/' . $this->location_id);
            case 2:
                return url('school/' . $this->location_id);
            case 3: //TODO: Check if course ids include this id
                return url('course/' . $this->location_id);
        }
    }

    public function getLocationName()
    {
        switch ($this->location_type) {
            case 1:
                $user = User::find($this->location_id);
                return "auf " . $user->first_name . " " . $user->last_name . "s";
            case 2:
                $school = School::find($this->location_id);
                return "in " . $school->name;
            case 3: //TODO: Check if course ids include this id
                $course = Course::find($this->location_id);
                return "in " . $course->name;
        }
    }
}
