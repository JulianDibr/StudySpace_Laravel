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

    public function votings()
    {
        return $this->hasMany('App\Voting');
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

    public function ownPosting(){
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
}
