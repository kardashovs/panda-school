<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    public function levels() {
        return $this->hasMany('App\Models\Level');
    }

}
