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

Route::get('/about', function(){
    return view('about');
});

Route::get('/project', function(){
    return view('project');
});

Route::get('routelist', "RoutesController@index");
Route::post('GetProjectWithinDistance', "ProjectController@getProjectWithinDistance");

Route::get('/project/info/{id}', "ProjectController@index")->name("project.info");
Route::post('/project/info/{id}', "ProjectController@facetInfo")->name("project.info.facet");

Route::get('/admin/home', 'HomeController@index');

Route::get('/admin/route', 'AdminRouteController@getRouteData');
Route::post('/admin/create/route', 'AdminRouteController@createRoute');
Route::post('/admin/remove/route', 'AdminRouteController@removeRoute');
Route::post('/admin/get/points', 'AdminRouteController@getRoutePoints');
Route::post('/admin/get/project', 'AdminRouteController@getProjectPoint');


Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});
Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

// Crud
Route::get('/beheer/projecten', 'ProjectController@main')->middleware('auth');
Route::get('/beheer/project/aanmaken', 'ProjectController@create')->middleware('auth');

Route::post('beheer/AddProject', 'ProjectController@addProject')->middleware('auth');
Route::post('beheer/updateProject', 'ProjectController@update')->middleware('auth');
Route::post('beheer/DeleteProject', 'ProjectController@destroy')->middleware('auth');
Route::get('/beheer/edit/{id}','ProjectController@edit')->middleware('auth');


Route::get('beheer/projectpoints/', 'ProjectPointsController@index');

// Return only data
Route::get('/getCategories', 'MainPageController@getCatagories');
Route::get('/getProjects', 'ProjectController@getProjects');

// Unnecessary : Could be deleted
Route::get('details', function() {
    abort(404);
});

Route::get('/leaflet', function(){
    return view('leafletExample');
});