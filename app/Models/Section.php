<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use Auth;

class Section extends Model
{
    public function lessons () {
        return $this->hasMany('App\Models\Lesson')->orderBy('sort', 'asc');
    }

    public function level () {
        return $this->belongsTo('App\Models\Level');
    }

    public function getSectionPercentAttribute()
    {
        $percent = 0;
        $tasksCount = $this->lessons()->count();
        $userTaskCount = Auth::user()->lessons()->where('section_id', $this->id)->wherePivot('complete', true)->count();
        if($userTaskCount != 0)
            $percent = floor($userTaskCount / $tasksCount * 100);
        return $percent;
    }
}
