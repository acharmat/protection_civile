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

Route::apiResource('/h','ApiController');

Route::get('/login','ApiController@accessToken');

Route::group(['middleware' => ['web','auth:api']], function()

{
    Route::post('/intervention/','ApiController@store');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {

    return $request->user();

});