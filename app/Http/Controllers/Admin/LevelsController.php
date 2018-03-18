<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Level;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Validator;
use Exception;

class LevelsController extends Controller
{
    public function index()
    {

        $levels = Level::with('language')->get();

        return response()->json([
            'levels'    => $levels,
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $errors = [];

        $lastLevel = Level::where([
            [ 'language_id', '=', $request->language_id ]
        ])
            ->orderBy('sort', 'asc')->get();

        $lastSort = $lastLevel->last();

        $isLevelName = Level::where([
            [ 'name', '=', $request->name ],
            [ 'language_id', '=', $request->language_id ]
        ])->get();

        if(count($isLevelName)) {
            $errors["name"] = true;

            return response()->json([
                'errors' => $errors,
            ], 200);
        }

        $newLevel = new Level;
        $newLevel->name = $request->name;
        $newLevel->title = $request->title;
        $newLevel->language_id = $request->language_id;
        $newLevel->description = $request->description;
        $newLevel->sort = ($lastSort)? $lastSort->sort+1 : 1;
        $newLevel->paid = !!$request->paid;

        $newLevel->save();

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('assets/levels/id-'. $newLevel->id .'/images');
            $url = Storage::disk('public')->url($path);
            $newLevel->image = $url;
        } else {
            $newLevel->image = '';
        }
        $newLevel->save();

        $isSort = $this->sortListUp($newLevel);

        return response()->json([
            'level'    => $newLevel,
            'isLevel' => count($isLevelName),
        ], 200);


    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $level = Level::find($id);

        if(!$level)
        {
            $errors['id'] = false;
            return response()->json([
                'errors' => $errors
            ], 200);
        }
        return response()->json([
            'level'    => $level,
        ], 200);
    }

    public function update(Request $request)
    {
        $errors = [];
        $isLevelName = Level::where([
            [ 'id', '<>', $request->id ],
            [ 'name', '=', $request->name ],
            [ 'language_id', '=', $request->language_id ]
        ])->get();

        if(count($isLevelName)) {
            $errors["name"] = true;
            return response()->json([
                'errors' => $errors,
            ], 200);
        }

        $level = Level::find($request->id);
        $level->name = $request->name;
        $level->title = $request->title;
        $level->language_id = $request->language_id;
        $level->description = $request->description;
        $level->sort = $request->sort;
        $level->paid = $request->paid;

        if($request->hasFile('image')) {

            if ($level->image) {

                $pathDir = dirname($level->image);
                Storage::disk('delete')->deleteDirectory($pathDir);
            }
            $path = $request->file('image')->store('assets/levels/id-'. $request->id .'/images');
            $url = Storage::disk('public')->url($path);
            $level->image = $url;
        } else {

            if ($request->image) {
                $level->image = $request->image;
            } else {
                if ($level->image) {
                    $pathDir = dirname($level->image);
                    Storage::disk('delete')->deleteDirectory($pathDir);
                }
                $level->image = '';
            }

        }

        $level->save();

        $isSort = $this->sortListUp($level);

        return response()->json([
            'level'    => $level,
            'sort' => $isSort
        ], 200);
    }

    public function destroy($id)
    {
        $level = Level::find($id);
        if(dirname(dirname($level->image))) {
            $pathDir = dirname(dirname($level->image));
            Storage::disk('delete')->deleteDirectory($pathDir);
        }

        try {
            $level->delete();
            return response()->json([], 200);
        }
        catch (Exception $e){
            $errors['delete'] = true;

            return response()->json([
                'errors' => $errors,
            ], 200);
        }


    }

    public function sortListUp($level)
    {

        $equivalentSortLevel = Level::where([
            [ 'id', '<>', $level->id],
            ['language_id', '=', $level->language_id],
            [ 'sort', '=', $level->sort ]
        ])->first();

        if(!$equivalentSortLevel) {
            return false;
        }

        $levelsForSort = Level::where('id', '<>', $level->id)
            ->where('language_id', $level->language_id)
            ->orderBy('sort', 'asc')
            ->get();


        foreach($levelsForSort as $key=>$item) {

            if ($key + 1 >= $level->sort) {
                $item->sort = $key + 2;
                $item->save();
            } else {
                $item->sort = $key + 1;
                $item->save();
            }
        }

        return true;
    }
}