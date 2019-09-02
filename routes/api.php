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

Route::middleware('auth:api')->group(function () {
    Route::post('/service/apilogout', 'NewAuthController@logout');
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/service/apiborrowbook', 'ApiTransaction@borrowBook');
    Route::get('/service/apiusertransaction', 'ApiTransaction@userTransaction');
});

Route::get('/', 'NewAuthController@login');
Route::post('/service/apiregister', 'NewAuthController@register');
Route::post('/service/apilogin', 'NewAuthController@login');
Route::get('/service/books','ApiBook@index');
Route::get('/service/books/{id}','ApiBook@bookdetail');
Route::get('/service/apitransaction', 'ApiTransaction@alltransaction');