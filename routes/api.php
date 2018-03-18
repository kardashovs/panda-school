<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/v1/user', function (Request $request) {
    return ['user' => $request->user(), 'roles' => $request->user()->roles];
});

Route::group( ['prefix' => 'v1', 'namespace' => 'Admin', 'middleware' => ['auth:api', 'role:manager'] ], function () {

    Route::apiResource('/languages', 'LanguagesController');
    Route::apiResource('/sections', 'SectionsController');
    Route::apiResource('/templates', 'TemplatesController');
    Route::apiResource('/lessons', 'LessonsController');
    Route::apiResource('/tasks', 'TasksController');



    Route::get('/levels', 'LevelsController@index');
    Route::get('/levels/edit={id}', 'LevelsController@edit');
    Route::put('/levels', 'LevelsController@update');
    Route::post('/levels', 'LevelsController@store');
    Route::delete('/level/delete/{id}', 'LevelsController@destroy');


});
