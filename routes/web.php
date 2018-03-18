<?php

Auth::routes();

Route::group( ['middleware' => ['language'] ], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::group( ['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => ['auth', 'role:user'] ], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard.home');
        Route::post('/{language_id}', 'DashboardController@changeLearnLanguage')->name('dashboard.language.changeLearnLanguage');

        Route::get('/lesson/{level_name}/{section_name}/{lesson_name}', 'LessonController@show')->name('dashboard.lesson');
        Route::post('/lesson/{level_name}/{section_name}/{lesson_name}', 'LessonController@checkLesson')->name('dashboard.lesson.check');

    });

});

Route::group( ['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:manager'] ], function () {
    Route::get('{path}', 'AdminDashboardController@index')->where('path', '(.*)');
    Route::get('/', 'AdminDashboardController@index')->name('admin.dashboard');

//    Route::get('/levels', 'LevelsController@index')->name('admin.levels');
//    Route::get('/levels/lang={language}', 'LevelsController@levels')->name('admin.levels.language');

//    Route::get('/level/id={id}', 'LevelsController@show')->name('admin.level');
});

//Смена языка – мультиязычность
Route::get('/lang/{language}', 'LanguageController@changeLangSite')->name('language');


