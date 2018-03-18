<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Level;
use Auth;
use View;

class LessonController extends Controller
{
//  Выборка урока
    private function currentLesson($level_name, $section_name, $lesson_name) {
        $language = Auth::user()->language->id;

        $level = Level::where([
            ['name', '=', $level_name],
            ['language_id', '=', $language]
        ])->firstOrFail();

        $section = $level->sections()->where([
            ['name', '=', $section_name],
            ['level_id', '=', $level->id]
        ])->first();

        $lesson = $section->lessons()->where([
            ['name', '=', $lesson_name],
            ['section_id', '=', $section->id]
        ])->first();

        return $lesson;
    }

//  Следующий урок
    private function nextLesson($lesson) {

        $nextlesson = $lesson->section->lessons()->where([
            ['sort', '>', $lesson->sort],
        ])
            ->orderBy('sort', 'asc')
            ->first();

        if($nextlesson) {
            return $nextlesson;
        }
//        if(!$nextlesson) {
//
//            $level = $lesson->section->level;
//            $section = $lesson->section;
//
//            $nextsection = $this->nextSection($level, $section);
//
//            $nextlesson = $level->sections()->where([
//                ['id', '=', $nextsection]
//            ])->first()
//                ->lessons()
//                ->orderBy('sort', 'asc')
//                ->first();
//
//        }

        return false;
    }
    // Следующий раздел
    private function nextSection($level, $section) {

        $nextsection = $level->sections()->where([
            ['sort', '>', $section->sort],
            ['level_id', '=', $level->id]
        ])->first();

        return $nextsection->id;
    }

    private function isAlphabet($template) {
        if ($template === 'alphabet')
            return true;
    }

    // Вывод урока
    public function show($level_name, $section_name, $lesson_name)
    {
        $lesson = $this->currentLesson($level_name, $section_name, $lesson_name);
        $nextlesson = $this->nextLesson($lesson);

        if (!View::exists($lesson->template->path)) {
            return view('dashboard.lessons.no-template', ['lesson' => $lesson, 'next_lesson' => $nextlesson]);
        }

        return view($lesson->template->path, ['lesson' => $lesson, 'next_lesson' => $nextlesson]);

    }

    // Выполнение урока
    public function checkLesson(Request $request, $level_name, $section_name, $lesson_name)
    {
        $lesson = $this->currentLesson($level_name, $section_name, $lesson_name);
        $nextlessonUrl = '';
        if($nextlesson = $this->nextLesson($lesson))
            $nextlessonUrl = route('dashboard.lesson', [$nextlesson->section->level->name, $nextlesson->section->name, $nextlesson->name]);

        $lesson->users()->detach(Auth::user()->id);

        if($this->isAlphabet($lesson->template->name))
        {
            $lesson->users()->attach(Auth::user()->id);
            return back()->with(['lesson-complited' => 'true', 'next' => $nextlessonUrl]);
        }

        if(!is_array($lesson->meta->body->vars_true)) {
            $array_value[] = $lesson->meta->body->vars_true;
        } else {
            $array_value = $lesson->meta->body->vars_true;
        }

        foreach($array_value as $item) {
            if(isset($item->value))
                $vars_array[] = $item->value;
            else
                $vars_array[] = $item;
        }



        if(count($request->result) === count($vars_array) && !array_diff_assoc( (array)$request->result, $vars_array)) {

            $lesson->users()->attach(Auth::user()->id);
            return back()->with(['lesson-complited' => 'true', 'next' => $nextlessonUrl]);
        }

//        return view($lesson->template->path, ['lesson' => $lesson, 'next_lesson' => $nextlesson]);

        return back()->with(['lesson-complited' => 'false', 'next' => $nextlessonUrl]);
    }


}
