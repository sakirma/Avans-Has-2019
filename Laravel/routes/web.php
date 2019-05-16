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





Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
});

Route::get('admin/login', 'Auth\LoginController@showLoginForm');
Route::post('admin/authenticate', 'Auth\LoginController@authenticate');


Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('details/{id}', "ProjectPointsController@GetDetails");

Route::get('getProjectPointIDs/{id}', "RoutesController@getProjectPointIDs");
Route::get('getProjectPoint/{projectPointId}', "ProjectPointsController@getProjectPointByID");
Route::get('getAllRoutes', "RoutesController@getAllRoutes");
Route::get('getProjectPointOfRoute/{id}', "RoutesController@getProjectPointOfRoute");
// Crud
// TODO: Change beheer to admin.
Route::get('beheer', 'ProjectController@main')->middleware('auth');

Route::get('/beheer/projecten', 'ProjectController@createProjectPage')->middleware('auth');
Route::get('/beheer/project/aanmaken', 'ProjectController@create')->middleware('auth');

Route::post('/beheer/AddProject', 'ProjectController@addProject')->middleware('auth');
Route::post('/beheer/updateProject', 'ProjectController@update')->middleware('auth');
Route::post('/beheer/DeleteProject', 'ProjectController@destroy')->middleware('auth');
Route::get('/beheer/edit/{id}','ProjectController@edit')->middleware('auth');
Route::get('/beheer/projectpoints/', 'ProjectPointsController@index');

Route::get('/admin/interestpoint/create', 'InterestPointController@create')->middleware('auth');
Route::post('/admin/addInterestPoint', 'InterestPointController@addInterestPoint')->middleware('auth');

Route::get('/admin/route', 'AdminRouteController@getRouteData')->middleware('auth');
Route::post('/admin/create/route', 'AdminRouteController@createRoute')->middleware('auth');
Route::post('/admin/remove/route', 'AdminRouteController@removeRoute')->middleware('auth');
Route::post('/admin/get/points', 'AdminRouteController@getRoutePoints')->middleware('auth');
Route::post('/admin/get/project', 'AdminRouteController@getProjectPoint')->middleware('auth');
/////////////////


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
