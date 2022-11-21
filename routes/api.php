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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group([
'middleware'=>'api',
'namespace'=>'App\Http\Controllers',
'prefix'=>'auth'
],function($router){
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout','AuthController@logout');
   // Route::post('login','authController@login');
   // Route::post('login','authController@login');
});

Route::group([
'middleware'=>'api',
'namespace'=>'App\Http\Controllers',
//'prefix'=>'product'
],function($router){
    Route::resource('product','produtController');
   
});
