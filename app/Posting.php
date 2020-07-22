<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Posting extends Model implements HasMedia {
    use InteractsWithMedia;

    protected $fillable = ['user_id', 'content', 'location_type', 'location_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getByUser($id) {
        return Posting::with('user')->where('user_id', $id)->get()->sortByDesc('updated_at');
    }

    public function getVoting() {
        return count($this->votings->where('is_upvote', true)) - count($this->votings->where('is_upvote', false));
    }

    public function getIsUpvoted() {
        return $this->votings->where('is_upvote', true)->contains('user_id', Auth::id());
    }

    public function getIsDownvoted() {
        return $this->votings->where('is_upvote', false)->contains('user_id', Auth::id());
    }

    public function ownPosting() {
        return $this->user_id === Auth::id();
    }

    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y, H:i');
    }

    public function getUpdatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y, H:i');
    }

    public function getFeed() {
        $user = Auth::user(); //TODO: get all relevant posts for $user => my profile, friends profiles, my groups, courses and school
        return Posting::with('user')->get()->sortByDesc('updated_at');
    }

    public function getLocationRoute() {
        switch ($this->location_type) {
            case 0:
                return route('home');
            case 1:
                return url('profile/' . $this->location_id);
            case 2:
                return url('school/' . $this->location_id);
            case 3:
                return url('course/' . $this->location_id);
            case 4:
                return url('group/' . $this->location_id);
            case 5:
                return url('project/' . $this->location_id);
        }

        return route('home');
    }

    public function getLocationName() {
        switch ($this->location_type) {
            case 1:
                $user = User::find($this->location_id);
                return "auf " . $user->getFullName() . "s";
            case 2:
                $school = School::find($this->location_id);
                return "in " . $school->name;
            case 3:
                $course = Course::find($this->location_id);
                return "in " . $course->name;
            case 4:
                $group = Group::find($this->location_id);
                return "in " . $group->name;
            case 5:
                $project = Project::find($this->location_id);
                return "in " . $project->name;
        }

        return false;
    }

    public function deletePosting() {
        if ($this !== null) {
            if ($this->user_id == Auth::id()) {

                foreach ($this->comments() as $comment) {
                    $comment->votings()->delete();
                    $comment->comments()->votings()->delete();
                    $comment->comments()->delete();
                    $comment->delete();
                }
                $this->votings()->delete();
                $this->delete();
            }
        }
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function votings() {
        return $this->hasMany('App\Voting');
    }
}
