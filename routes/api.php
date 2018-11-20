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


// Using REST convention for the routes, or as close I can get to it anyway.

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// Routes dedicated to logging in and registering. 
Route::post('login', 'UsersController@login');
Route::post('register', 'UsersController@register');


// Routes protected by passport authentication.
Route::group(['middleware' => 'auth:api'], function(){
    // Resource controller routes. Mostly just tasks and categories.
	Route::resource('/task', 'TaskController');
	Route::resource('/category', 'CategoryController');

    // Specific route for returning tasks by category.
	Route::get('/category/{category}/tasks', 'CategoryController@tasks');
});