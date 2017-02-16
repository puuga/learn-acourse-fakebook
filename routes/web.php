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
    return view('welcome-v2');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'profile'], function () {
  Route::get('/', 'ProfileController@myProfile')->name('profile_my');
  Route::get('/{id}', 'ProfileController@show')->name('profile_show');
});

Route::group(['prefix' => 'timeline'], function () {
  Route::post('/', 'TimelineController@store')->name('timeline_store');
});
