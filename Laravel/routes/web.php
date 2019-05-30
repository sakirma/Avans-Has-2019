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
Route::get('details/{id}', "ProjectPointController@getDetails");

Route::post('/location', "ProjectPointController@getLocationData");

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

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/authenticate', 'Auth\LoginController@authenticate');


Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('details/{id}', "ProjectPointController@GetDetails");

Route::get('getProjectPointIDs/{id}', "RoutesController@getProjectPointIDs");
Route::get('getProjectPoint/{projectPointId}', "ProjectPointController@getProjectPointByID");
Route::get('getAllRoutes', "RoutesController@getAllRoutes");
Route::get('getProjectPointOfRoute/{id}', "RoutesController@getProjectPointOfRoute");
// Crud
// TODO: Change beheer to admin.
Route::get('admin', 'ProjectController@main')->middleware('auth');

Route::get('/getAllProjectPoints', "ProjectPointsController@getAllPoints");

Route::group(['middleware' => ['auth']], function () {
    Route::get('beheer', 'ProjectController@main');

//Route::post('/beheer/AddProjectPoint', 'ProjectController@addProject')->middleware('auth');
//Route::post('/beheer/updateProject', 'ProjectController@update')->middleware('auth');
//Route::post('/beheer/DeleteProject', 'ProjectController@destroy')->middleware('auth');
//Route::get('/beheer/edit/{id}','ProjectController@edit')->middleware('auth');
//Route::get('/beheer/projectpoints/', 'ProjectPointController@index');

Route::get('/admin/projectpoints', 'ProjectPointController@viewProjectPoints')->middleware('auth');
Route::get('/admin/projectpoint/create', 'ProjectPointController@create')->middleware('auth');
Route::get('/admin/projectpoint/edit/{id}','ProjectPointController@edit')->middleware('auth');
Route::post('/admin/addProjectPoint', 'ProjectPointController@addProjectPoint')->middleware('auth');
Route::post('/admin/updateProjectPoint', 'ProjectPointController@update')->middleware('auth');
Route::post('/admin/deleteProjectPoint', 'ProjectPointController@destroy')->middleware('auth');

Route::post('/admin/addProject', 'ProjectController@addProject')->middleware('auth');
Route::post('/admin/updateProject', 'ProjectController@update')->middleware('auth');
Route::post('/admin/deleteProject', 'ProjectController@deleteProject')->middleware('auth');





    Route::get('/admin/route', 'AdminRouteController@getRouteData');
    Route::post('/admin/create/route', 'AdminRouteController@createRoute');
    Route::post('/admin/remove/route', 'AdminRouteController@removeRoute');
    Route::post('/admin/get/points', 'AdminRouteController@getRoutePoints');
    Route::post('/admin/get/project', 'AdminRouteController@getProjectPoint');
});


// Return only data
Route::get('/getCategories', 'MainPageController@getCatagories');
Route::get('/getProjects', 'ProjectController@getProjects');
Route::get('/getProjectNames', 'ProjectController@getProjectNames');

Route::get('/getProjectPoints', 'ProjectPointController@getProjectPoints');

// Unnecessary : Could be deleted
Route::get('details', function() {
    abort(404);
});

Route::get('/leaflet', function(){
    return view('leafletExample');
});
