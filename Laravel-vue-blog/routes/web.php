<?php


use Illuminate\Support\Facades\Route;


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

Route::get('/','TestController@new');
Route::get('/new','TestController@newmethod');
// Route::get('/app/createtag','TestController@test');
// Route::post('/app/create_tag','TestController@test');
Route::post('/app/create_tag','AdminController@addTag');
Route::post('/app/edit_tag','AdminController@editTag');
Route::get('/app/get_tags','AdminController@getTag');
Route::any('{slug}',function(){
return view('welcome');
});


