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


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::patch('/userprofile/update/{id}', 'Admin\UserProfileController@update')->name('userprofile.update');
Route::get('/admin/gamesList', 'Admin\GameController@gamesList')->name('game.list');
Route::resource('/admin/game', 'Admin\GameController');
