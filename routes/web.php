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

//Route::get('/', function () {
//    return view('pages.welcome');
//});

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/organizations', 'PagesController@organizations');
Route::get('/teachers', 'PagesController@teachers');
Route::get('/locations', 'PagesController@locations');
Route::resource('/courses', 'CoursesController');



Route::resource('queries', 'QueryController');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
