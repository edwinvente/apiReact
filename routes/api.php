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

//rutas de las categorias
Route::get('/categories', 'CategoryController@index');
Route::post('/categories/store', 'CategoryController@store');
Route::post('/categories/update', 'CategoryController@update');

//rutas de los productos
Route::get('/products', 'ProductController@index');

//ruta de prueba
Route::get('/test', 'CategoryController@index');
