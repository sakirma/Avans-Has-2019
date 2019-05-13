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


Route::group(['middleware' => 'api'], function () {
// Crud
// TODO: Change beheer to admin.
    Route::get('beheer', 'ProjectController@main');

    Route::get('/beheer/projecten', 'ProjectController@createProjectPage');
    Route::get('/beheer/project/aanmaken', 'ProjectController@create');

    Route::post('/beheer/AddProject', 'ProjectController@addProject');
    Route::post('/beheer/updateProject', 'ProjectController@update');
    Route::post('/beheer/DeleteProject', 'ProjectController@destroy');
    Route::get('/beheer/edit/{id}','ProjectController@edit');
    Route::get('/beheer/projectpoints/', 'ProjectPointsController@index');


    Route::get('/admin/route', 'AdminRouteController@getRouteData');
    Route::post('/admin/create/route', 'AdminRouteController@createRoute');
    Route::post('/admin/remove/route', 'AdminRouteController@removeRoute');
    Route::post('/admin/get/points', 'AdminRouteController@getRoutePoints');
    Route::post('/admin/get/project', 'AdminRouteController@getProjectPoint');
/////////////////
});

