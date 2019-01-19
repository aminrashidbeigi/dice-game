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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('game', 'Api\GameController@index');
Route::post('/game/{id}/comment', 'Api\CommentController@store')->name('comment.store');
Route::get('/game/{id}', 'Api\GameController@getGame')->name('get.game');
Route::get('/gamestatus/{id}', 'Api\GameStatusController@sendGameStatus')->name('gamestatus');