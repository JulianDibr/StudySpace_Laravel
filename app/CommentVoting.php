<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentVoting extends Model
{
    protected $fillable = ['user_id', 'comment_id', 'is_upvote'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

    public function posting()
    {
        return $this->belongsTo('App\Posting');
    }
}
