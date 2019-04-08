<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'MainPageController@GetCatagories');

Route::get('/leaflet', function(){
    return view('leafletExample');
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/project', function(){
    return view('project');
});

Route::get('details', function() {
    abort(404);
});

Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('details/{id}', "ProjectPointsController@GetDetails");