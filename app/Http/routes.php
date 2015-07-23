<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');

Route::get('posts/tags/{id}', 'PostsController@tags');

Route::get('posts/{id}','PostsController@show');

Route::resource('posts','PostsController');

Route::resource('comments','CommentsController');

Route::resource('users','UsersController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('posts/addLike/{id}', 'PostsController@addLike');
Route::get('posts/addDislike/{id}', 'PostsController@addDislike');
Route::get('posts/deletePost/{id}', 'PostsController@deletePost');
Route::get('users/posts/{id}', 'PostsController@userPosts');
Route::get('admin', 'UsersController@admin');


Route::post('posts/updatePost', 'PostsController@updatePost');
Route::post('users/updateUser', 'UsersController@updateUser');
Route::post('search', 'PostsController@search');

