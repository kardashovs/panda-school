<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SectionController extends Controller
{
    public static function level() {

        $tasks = Lesson::whereHas('section', function ($query) {
            $query->whereHas('level', function ($query) {
                $query->where('language_id', Auth::user()->language_id);
            });
        })->get();

        $calcLevelTask = count($tasks)/5;

        $userTasks = Auth::user()->lessons()->wherePivot('complete', true)->get();

        $level = round(count($userTasks)/$calcLevelTask);

        if($level < 1)
            $level = 1;

        return $level;
    }

    public static function levelPercent() {


        $tasks = Lesson::whereHas('section', function ($query) {
            $query->whereHas('level', function ($query) {
                $query->where('language_id', Auth::user()->language_id);
            });
        })->get();

        $calcLevelTask = count($tasks)/5;

        $userTasks = Auth::user()->lessons()->wherePivot('complete', true)->get();

        $levelPercent = round(count($userTasks) / count($tasks) * 100);

        return $levelPercent;
    }

}
