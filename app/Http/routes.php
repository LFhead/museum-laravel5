<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('about', 'sitescontroller@about');
//Route::get('/authapp', function(){return view('layouts.app');});

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

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'sitescontroller@index');
    Route::get('list', ['middleware'=>'auth','uses'=>'sitescontroller@collection_list']);
    Route::get('favorates', ['middleware'=>'auth','uses'=>'sitescontroller@favorates']);
    //Route::get('collection/create','sitescontroller@create');
    Route::get('collection/create',['middleware'=>'admin','uses'=>'sitescontroller@create']);
    Route::post('collection/update',['middleware'=>'admin','uses'=>'sitescontroller@update']);
    Route::post('collection/delete',['middleware'=>'admin','uses'=>'sitescontroller@delete']);
    Route::get('collection/edit/{id}',['middleware'=>'admin','uses'=>'sitescontroller@edit']);
    Route::post('collection/store',['middleware'=>'admin','uses'=>'sitescontroller@store']);
    Route::get('collections/{id}', ['middleware'=>'auth','uses'=>'sitescontroller@show']);
    Route::get('collection/like/{id}',['middleware'=>'auth','uses'=>'sitescontroller@like']);
    Route::get('collection/dislike/{id}',['middleware'=>'auth','uses'=>'sitescontroller@dislike']);
    Route::get('user/list',['middleware'=>'admin','uses'=>'sitescontroller@user_list']);

    Route::get('/home', 'HomeController@index');
});
