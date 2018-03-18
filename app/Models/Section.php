<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function lessons () {
        return $this->hasMany('App\Models\Lesson')->orderBy('sort', 'asc');
    }

    public function level () {
        return $this->belongsTo('App\Models\Level');
    }

}
