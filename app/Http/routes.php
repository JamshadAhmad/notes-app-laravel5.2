<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web','auth']], function () {

    Route::get('/notes', 'NoteController@index');
    Route::post('/store', 'NoteController@save');
    Route::get('/remove/{note}', 'NoteController@delete');

    Route::get('/', function () {
        return view('welcome');
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
});

Route::group(['middleware' => 'auth.basic'], function () {
    Route::get('/api/v1/notes/{id?}', 'ApiController@index');
});
