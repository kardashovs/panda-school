<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use Illuminate\Support\Facades\Lang;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class LanguagesController extends Controller
{

    public function index()
    {
        $languages = Language::all();

        return ['languages' => $languages];

    }

    public function store(Request $request)
    {

        $errors = [];

        $isLanguage = Language::where([['name','=', $request->name]])->get();
        if(count($isLanguage)) {
            $errors["name"] = true;

            return response()->json([
                'errors' => $errors,
            ], 200);
        }

        $language = new Language();
        $language->name = $request->name;
        $language->title = $request->title;

        $language->save();

        if($request->hasFile('image'))
        {
            $ext = $request->file('image')->getClientOriginalExtension();

            $path = $request->file('image')
                ->storeAs('assets/languages/id-'. $language->id .'/images', $request->name.'.'.$ext);
            $url = Storage::disk('public')->url($path);
            $language->icon2x = $url;
            $language->icon = $url;
        } else {
            $language->icon2x = '';
            $language->icon = '';
        }
        $language->save();

        return response()->json([
            'language'    => $language,
        ], 200);
    }

    public function show($id)
    {
        $language = Language::find($id);
        return response()->json([
            'language'    => $language,
            'languageFirst'    => $language->name,
        ], 200);
    }

    public function update(Request $request, $id)
    {

        $language = Language::find($id);
        if(!$language) {
            return response()->json([
                'errors' => true,
            ], 200);
        }

        $language->name = $request->name;
        $language->title = $request->title;

        if($request->hasFile('image')) {

            if ($language->icon2x) {

                $pathDir = dirname($language->icon2x);

                Storage::disk('delete')->deleteDirectory($pathDir);
            }
            $path = $request->file('image')->store('assets/languages/id-'. $id .'/images');
            $url = Storage::disk('public')->url($path);
            $language->icon2x = $url;
            $language->icon = $url;
        } else {
            if ($request->image) {
                $language->icon2x = $request->image;
                $language->icon = $request->image;
            } else {
                if ($language->icon2x) {
                    $pathDir = dirname($language->icon2x);
                    Storage::disk('delete')->deleteDirectory($pathDir);
                }
                $language->icon2x = '';
                $language->icon = '';
            }
        }

        $language->save();

        return response()->json([
                'language' => $language
        ], 200);
    }

    public function destroy($id)
    {
        $language = Language::find($id);
        if(dirname(dirname($language->image))) {
            $pathDir = dirname(dirname($language->image));
            Storage::disk('delete')->deleteDirectory($pathDir);
        }

        try {
            $language->delete();
            return response()->json([], 200);
        }
        catch (Exception $e){
            $errors['delete'] = true;

            return response()->json([
                'errors' => $errors,
            ], 200);
        }
    }
}
