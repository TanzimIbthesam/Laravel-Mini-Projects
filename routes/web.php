<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home','HomeController@index');
Route::get('/users','UserController@index');

Route::get('/todos','TodoController@index')->name('todo.index');
Route::get('/todos/create','TodoController@create');
Route::post('/todos/create','TodoController@store');
//Laravel-6
// Route::get('/todos/edit/{id}','TodoController@edit');
//Route for dynamic model binding
// Route::get('/todos/edit/{todo}','TodoController@edit');
//if we want to define with title
Route::get('/todos/edit/{todo}','TodoController@edit');
Route::patch('/todos/update/{todo}','TodoController@update')->name('todo.update');

Auth::routes();
Route::post('/upload','UserController@avartarupload' );

Route::get('/home', 'HomeController@index')->name('home');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
