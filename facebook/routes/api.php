<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::get('auth-user', 'AuthUserController@show');



});
Route::apiResources([

    '/posts' => 'PostController',
    '/posts/{post}/like' => 'PostLikeController',
    '/users' => 'UserController',
    '/users/{user}/posts' => 'UserPostController',
    '/friend-request'=>'FriendRequestController',
    '/friend-request-response'=>'FriendRequestResponseController'

]);
// Route::apiResources([

//     'posts' => 'PostController',
//     'users'=>'UserController'
// ]);
// Route::resource('users', 'UserController');
// Route::resource('posts', 'PostController');
// Route::get('/posts', 'PostController@index');
// Route::post('/posts', 'PostController@store');
// Route::get('/users','UserController@show');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
