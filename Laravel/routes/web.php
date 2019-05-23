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

Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/authenticate', 'Auth\LoginController@authenticate');


Route::get('/media', "MediaController@index")->name('media');

Route::post('/media', "MediaController@saveMedia")->name('media.save');

Route::get('/getmedia/{name}', "MediaController@getMedia")->name('media.get');

Route::get('details/{id}', "ProjectPointsController@GetDetails");

Route::get('getProjectPointIDs/{id}', "RoutesController@getProjectPointIDs");
Route::get('getProjectPoint/{projectPointId}', "ProjectPointsController@getProjectPointByID");
Route::get('getAllRoutes', "RoutesController@getAllRoutes");
Route::get('getProjectPointOfRoute/{id}', "RoutesController@getProjectPointOfRoute");


Route::group(['middleware' => ['auth']], function () {

    Route::get('beheer', 'ProjectController@main');

    Route::get('/beheer/projecten', 'ProjectController@createProjectPage');
    Route::get('/beheer/project/aanmaken', 'ProjectController@create');

    Route::post('/beheer/AddProject', 'ProjectController@addProject');
    Route::post('/beheer/updateProject', 'ProjectController@update');
    Route::post('/beheer/DeleteProject', 'ProjectController@destroy');
    Route::get('/beheer/edit/{id}','ProjectController@edit');
    Route::get('/beheer/projectpoints/', 'ProjectPointsController@index');


});

Route::get('/admin/route', 'AdminRouteController@getView');
Route::post('/admin/route/data', 'AdminRouteController@getRouteData');
Route::post('/admin/route/create', 'AdminRouteController@createRoute');
Route::post('/admin/route/remove', 'AdminRouteController@removeRoute');
Route::post('/admin/route/points', 'AdminRouteController@getRoutePoints');
Route::post('/admin/route/projects', 'AdminRouteController@getProjectPoint');


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
