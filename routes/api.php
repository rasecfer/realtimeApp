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

Route::post('notifications', 'NotificationController@index');

Route::post('notifications/markAsRead', 'NotificationController@markOne');

Route::post('notifications/markAllAsRead', 'NotificationController@markAll');

Route::group([
  'middleware' => 'api',
  'prefix' => 'auth'
], function ($router) {
  Route::post('login', 'AuthController@login');
  Route::post('signup', 'AuthController@signup');
  Route::post('logout', 'AuthController@logout');
  Route::post('refresh', 'AuthController@refresh');
  Route::post('me', 'AuthController@me');
});
