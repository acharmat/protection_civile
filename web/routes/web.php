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

////sudo php artisan serve --host 192.168.5.235 --port 80


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/administration')->group(function() {

    Route::get('hopital/create', 'HopitalController@create');



    Route::get('/', 'SuperAdminController@index');

    Route::prefix('/admin')->group(function() {
        Route::get('/data',['as' => 'administration.admin.data' , 'uses' =>'SuperAdminController@getAdminData']);
        Route::get('/', 'SuperAdminController@index');
        Route::post('/store', 'SuperAdminController@store');


    });

    Route::prefix('/hopital')->group(function() {

        Route::get('/data',['as' => 'administration.hopital.data' , 'uses' =>'HopitalController@getHopitalsData']);

        Route::get('/', 'HopitalController@index');
        Route::get('{hopital}', 'HopitalController@show');
        Route::post('/store', 'HopitalController@store');
        Route::post('/storeservice', 'HopitalController@storeservice');
        Route::post('/storeadmin', 'HopitalController@storeadmin');
        Route::get('{hopital}/edit', 'HopitalController@edit');
        Route::post('/update', 'HopitalController@update');
        Route::get('{hopital}/destroy', 'HopitalController@destroy');


 //       Route::post('{hopital}/services/{service}/destroyservice', 'HopitalController@destroyservice');


        Route::prefix('{hopital}/admin')->group(function() {
            Route::get('/data',['as' => 'administration.admin.data' , 'uses' =>'HopitalController@getAdminData']);
        });


        Route::prefix('{hopital}/services')->group(function() {
            Route::get('/data',['as' => 'administration.services.data' , 'uses' =>'HopitalController@getServicesData']);
            Route::get('{service}/edit', 'HopitalController@editservice');
            Route::post('/update', 'HopitalController@updateservice');
        });



    });

    Route::prefix('/services')->group(function() {
        Route::get('/data',['as' => 'administration.services.data' , 'uses' =>'ServiceController@getServiceData']);

        Route::get('/', 'ServiceController@index');
        Route::post('/store', 'ServiceController@store');
        Route::get('{service}/edit', 'ServiceController@edit');
        Route::post('/update', 'ServiceController@update');
        Route::get('{service}/destroy', 'ServiceController@destroy');


    });

});


Route::get('/station', 'AdminController@index');
Route::get('/admin', 'HopitalAdminController@index');








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
