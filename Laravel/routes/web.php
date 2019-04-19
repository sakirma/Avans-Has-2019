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
Route::get('/', 'MainPageController@index');
Route::get('details/{id}', "ProjectPointsController@getDetails");

Route::post('/location', "ProjectPointsController@getLocationData");

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

Route::get('routelist', "RoutesController@index");

Route::post('AddProject', "ProjectController@SetPointLocation");
Route::post('GetProjectWithinDistance', "ProjectController@GetProjectLocations");

Route::get('/project/info/{id}', "ProjectController@index")->name("project.info");

Route::get('/home', 'MainPageController@GetCatagories');
Route::get('/admin/home', 'HomeController@index');
Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});
Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('details/{id}', "ProjectPointsController@GetDetails");
