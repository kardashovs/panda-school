<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


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

    public function checkUser() {
        return $this->users->where('id', Auth::user()->id)->first();
    }
}
