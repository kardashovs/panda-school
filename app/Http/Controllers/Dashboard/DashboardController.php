<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Level;

class DashboardController extends Controller
{

    public function index()
    {
        $levels = Level::where('language_id', Auth::user()->language->id)
                        ->with(['sections',
                            'sections.lessons',
                            'sections.lessons.users' => function($query) {
                            $query->where('user_id', Auth::user()->id)->withPivot('complete');
                        }])
                        ->orderBy('sort', 'asc')
                        ->get();

        return view('dashboard.index', ['levels' => $levels]);
    }


    public function changeLearnLanguage($lang_id)
    {
        $user = Auth::user();
        $user->language_id = $lang_id;
        $user->update();
        return redirect('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
