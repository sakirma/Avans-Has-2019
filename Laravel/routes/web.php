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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/leaflet', function(){
    return view('leafletExample');
});

Route::get('/about', function(){
    return view('about');
});

Route::get('/project', function(){
    return view('project');
});

Route::get('home/', 'MainPageController@GetCatagories');

Route::get('details', function() {
    abort(404);
});

Route::get('details/{id}', "ProjectPointsController@GetDetails");