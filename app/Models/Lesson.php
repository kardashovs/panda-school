<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $casts = [
        'meta' => 'object',
    ];

    public function template () {
        return $this->belongsTo('App\Models\Template');
    }

    public function section() {
        return $this->belongsTo('App\Models\Section');
    }

    public function users () {
        return $this->belongsToMany('App\User');
    }
}
