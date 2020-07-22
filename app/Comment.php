<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model {
    protected $guarded = ['id'];

    public function posting() {
        return $this->belongsTo('App\Posting');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function votings() {
        return $this->hasMany('App\CommentVoting');
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

    public function ownComment() {
        return $this->user_id === Auth::id();
    }

    public function setFirstNameAttribute($value) {
        $this->attributes['content'] = $value;
    }
}
