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
