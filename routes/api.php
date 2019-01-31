<?php

use Illuminate\Http\Request;

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