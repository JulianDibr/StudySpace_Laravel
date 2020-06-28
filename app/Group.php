<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description', 'image', 'admin_id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function admin(){
        return $this->belongsTo('App\User');
    }

    public function postings() {
        return $this->hasMany('App\Posting');
    }

    public function getGroupImage() {
        if($this->image) {
            return asset('storage/profile_pictures/groups/' . $this->image);
        } else {
            return asset('storage/profile_pictures/groups/default.jpg');
        }
    }
}
