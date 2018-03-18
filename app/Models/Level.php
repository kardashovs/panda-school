<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Level extends Model
{
    protected $fillable = [
        'name', 'title', 'description', 'language_id', 'sort', 'paid'
    ];

    public function sections() {
        return $this->hasMany('App\Models\Section');
    }

    public function language() {
        return $this->belongsTo('App\Models\Language');
    }

}
