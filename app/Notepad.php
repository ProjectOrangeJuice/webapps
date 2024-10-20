<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notepad extends Model
{

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
