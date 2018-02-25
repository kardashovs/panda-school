<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function sections() {
        return $this->hasMany('App\Models\Section');
//        return $this->hasMany('App\Models\Section')->orderBy('sort','asc');
    }
}
