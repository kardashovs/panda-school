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

        SectionController::level();
        $lesson = $this->currentLesson($level_name, $section_name, $lesson_name);
        $nextlesson = $this->nextLesson($lesson);

        if (!View::exists($lesson->template->path)) {
            return view('dashboard.lessons.no-template', ['lesson' => $lesson, 'next_lesson' => $nextlesson]);
        }

        if(isset($lesson->meta->body->word)) {
            $text = $lesson->meta->body->word;
            $input = '<input type="text" class="lesson__input__word__missing__letter" name="result[]" placeholder="_" value="" maxlength="1"/>';
            foreach($lesson->meta->body->vars_true as $item):
                $text = str_replace_first('['.$item.']', $input, $text);
            endforeach;
            $lesson->word = $text;
        }


        return view($lesson->template->path, ['lesson' => $lesson, 'next_lesson' => $nextlesson]);

    }

    // Выполнение урока
    public function checkLesson(Request $request, $level_name, $section_name, $lesson_name)
    {

        //вывод предыдущего значения процентов прогресса общего
        $oldPercentMain = SectionController::levelPercent();
        //Поиск и вывод урл следующего урока
        $lesson = $this->currentLesson($level_name, $section_name, $lesson_name);
        $nextlessonUrl = '';
        if($nextlesson = $this->nextLesson($lesson))
            $nextlessonUrl = route('dashboard.lesson', [$nextlesson->section->level->name, $nextlesson->section->name, $nextlesson->name]);

        //Проверка на существование записи урока и юзера
        if(!$lesson->users->where('id', Auth::user()->id)->first())
            $lesson->users()->save(Auth::user(), ['complete' => false]);

        //Обновление выполнения урока
        $lesson->users()->updateExistingPivot(Auth::user()->id, ['complete' => false]);



        //Если алфавит то выполнить урок
        if($this->isAlphabet($lesson->template->name))
        {
            $lesson->users()->updateExistingPivot(Auth::user()->id, ['complete' => true]);
            return back()->with(['oldPercent' => $oldPercentMain,'lesson-complited' => 'true', 'next' => $nextlessonUrl]);
        }

        //Проверка на массив
        if(!is_array($lesson->meta->body->vars_true)) {
            $array_value[] = $lesson->meta->body->vars_true;
        } else {
            $array_value = $lesson->meta->body->vars_true;
        }

        //перевод в массив вложенного значения верного ответа массива
        foreach($array_value as $item) {
            if(isset($item->value))
                $vars_array[] = $item->value;
            else
                $vars_array[] = $item;
        }

        //сравнение массива и приведение значений в нижний регистр
        if(count($request->result) === count($vars_array) && !array_diff_assoc( array_map('strtolower',(array)$request->result), array_map('strtolower',$vars_array))) {

            $lesson->users()->updateExistingPivot(Auth::user()->id, ['complete' => true]);
            //вывод результата о выполнение
            return back()->with(['oldPercent' => $oldPercentMain,'lesson-complited' => 'true', 'next' => $nextlessonUrl]);
        }

        //вывод результата о не выполнение
        return back()->with(['oldPercent' => $oldPercentMain,'lesson-complited' => 'false', 'next' => $nextlessonUrl]);
    }


}
