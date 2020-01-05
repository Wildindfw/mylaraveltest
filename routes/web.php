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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/users/create', 'UsersController@create');
Route::post('/users/login', 'SessionController@login');
Route::get('/users/logout', 'SessionController@logout');

Route::middleware('api_token')->group(function () {
    Route::post('/users/update', 'UsersController@update');
    Route::get('/users/likes', 'LikesController@user');

    Route::get('/feeds', 'FeedsController@index');

    Route::get('/posts', 'PostsController@index');
    Route::post('/posts/create', 'PostsController@create');
    Route::post('/posts/update/{idPost}', 'PostsController@update');
    Route::delete('/posts/{idPost}', 'PostsController@delete');
    Route::get('/posts/likes/{idPost}', 'LikesController@post');

    Route::middleware('checkUser')->group(function () {
        Route::get('/followers/{idUser}', 'FollowController@followers');
        Route::get('/followers/users/{idUser}', 'FollowController@followersUsers');

        Route::get('/following/{idUser}', 'FollowController@followings');
        Route::get('/following/users/{idUser}', 'FollowController@followingsUsers');
        Route::post('/following/save/{idUser}', 'FollowController@save');
    });

    Route::post('/likes/save/{idPost}', 'LikesController@save');
});
