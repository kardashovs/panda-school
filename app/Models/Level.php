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

    public function getLevelPercentAttribute() {
        $summ = 0;
        $count = 0;
        foreach ($this->sections as $item):
            if($item->lessons->count()):
                $count++;
                $summ += floor($item->section_percent);
            endif;
        endforeach;

        if($count != 0)
            $summ = floor($summ/$count);

        return $summ;
    }

}
