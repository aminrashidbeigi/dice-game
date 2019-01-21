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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::patch('/userprofile/update/{id}', 'Admin\UserProfileController@update')->name('userprofile.update');
Route::get('/admin/gamesList', 'Admin\GameController@gamesList')->name('game.list');
Route::get('/admin/game/playing', 'Admin\GameController@playingGames')->name('game.playing');
Route::resource('/admin/game', 'Admin\GameController');
Route::resource('/admin/game', 'Admin\GameController');
Route::post('/comment/accept/{id}', 'Admin\CommentAcceptController@acceptComment')->name('comment.accept');
Route::post('/comment/reject/{id}', 'Admin\CommentAcceptController@rejectComment')->name('comment.reject');
