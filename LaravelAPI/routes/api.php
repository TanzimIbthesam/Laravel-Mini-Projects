<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/students','APIController@store');
Route::get('/getstudents','APIController@show');
Route::get('/getstudents/{id}','APIController@showbyid');
 Route::put('/getstudentsupdate/{id}','APIController@updatebyid');
 Route::patch('/deletestudents/{id}','APIController@destroy');
// Route::put('/getstudentsupdate/{id}', 'APIController@updatebyid');
