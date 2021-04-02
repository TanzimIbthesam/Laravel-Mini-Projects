<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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
// Route::get('/products', function () {
//     return Product::all();
    
// });
// Route::get('/products', [ProductController::class,'index']);
// Route::post('/products', [ProductController::class,'store']);
// Since its a resource Controller we can write
Route::resource('products', ProductController::class);
 Route::get('/products/search/{name}', [ProductController::class,'search']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
