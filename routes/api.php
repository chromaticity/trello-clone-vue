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

// Routes dedicated to logging in and registering. 
Route::post('login', 'UsersController@login');
Route::post('register', 'UsersController@register');


// Routes protected by passport authentication.
Route::group(['middleware' => 'auth:api'], function(){
	
    // Resource controller routes. Mostly just tasks and categories.
	Route::resource('/task', 'TaskController');
	Route::resource('/category', 'CategoryController');

	// Any user related routes such as profiles, etc. go here.
	Route::get('getDetails', 'UsersController@getDetails');
	Route::post('logout', 'UsersController@logout');

    // Specific route for returning tasks by category.
	Route::get('/category/{category}/tasks', 'CategoryController@tasks');
});