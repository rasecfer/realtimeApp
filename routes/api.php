<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Con apiResource toma todas las rutas del Controller
 * get -> index
 * post -> store
 * get -> show
 * put/patch -> update
 * delete -> destroy
 */
Route::apiResource('/question', 'QuestionController');

Route::apiResource('/category', 'CategoryController');

Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt');

Route::delete('/like/{reply}', 'LikeController@unLikeIt');

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function ($router) {
  Route::post('login', 'AuthController@login');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
});
