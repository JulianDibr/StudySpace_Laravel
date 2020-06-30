<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'image', 'admin_id'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function admin()
    {
        return $this->belongsTo('App\User');
    }

    public function postings()
    {
        return $this->hasMany('App\Posting');
    }

    public function getProjectImage()
    {
        if ($this->image) {
            return asset('storage/profile_pictures/projects/' . $this->image);
        } else {
            return asset('storage/profile_pictures/projects/default.jpg');
        }
    }
}
