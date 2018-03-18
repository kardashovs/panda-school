<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ['sections' => Section::with(['lessons','level'])->withCount('lessons')->get()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sections = Section::where([
            ['name', '=', $request->name],
            ['level_id', '=', $request->level_id]
        ])->get();
        if(count($sections)) {
            return ['errors' => true];
        }
        $sections = Section::whereLevelId($request->level_id)->get();
        $section = new Section;
        $section->name = $request->name;
        $section->title = $request->title;
        $section->level_id = $request->level_id;
        $section->sort = ($sections->last())? $sections->last()->sort +1 : 1;
        $section->save();
        $this->sort($section->id);

        return ['section' => $section];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::find($id);
        $section->language = $section->level->language->id;
        $levels = Level::all();
        $languages = Language::all();

        return [
            'section' => $section,
            'levels' => $levels,
            'languages' => $languages
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $section = Section::find($id);
        $section->name = $request->name;
        $section->title = $request->title;
        $section->level_id = $request->level_id;
        $section->sort = $request->sort;
        $section->save();

        $this->sort($id);

        return ['section' => $this->sort($id)];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return ['delete' => true];
    }

    public function sort($id)
    {

        $section = Section::find($id);
        if(!$section) {
            return $section;
        }
        $isSection = Section::where('id', '<>', $id)
            ->where('level_id', $section->level_id)
            ->where('sort', $section->sort)
            ->get();
        if(!count($isSection)) {
            return $isSection;
        }

        $sections = Section::where('level_id', $section->level_id)
            ->where('id', '<>', $section->id)
            ->orderBy('sort', 'asc')
            ->get();

        foreach($sections as $key=>$item) {

            if ($key + 1 >= $section->sort) {
                $item->sort = $key + 2;
                $item->save();
            } else {
                $item->sort = $key + 1;
                $item->save();
            }
        }

        return $sections;
    }
}
