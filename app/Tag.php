<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
        return $this->belongsToMany("App\Post")->withPivot("confirmed");
    }

    public function admins(){
        return $this->belongsToMany("App\User");
    }


}
