<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $casts = [
        'fields' => 'collection',
    ];

    public function lessons() {
        return $this->hasMany('App\Models\Lesson');
    }
}
