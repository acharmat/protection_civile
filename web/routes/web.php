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
        Route::get('{admin}/edit', 'SuperAdminController@edit');
        Route::post('/update', 'SuperAdminController@update');
        Route::get('{admin}/destroy', 'SuperAdminController@destroy');

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



        Route::prefix('{hopital}/admin')->group(function() {
            Route::get('/data',['as' => 'administration.admin.data' , 'uses' =>'HopitalController@getAdminData']);
        });


        Route::prefix('{hopital}/services')->group(function() {
            Route::get('/data',['as' => 'administration.services.data' , 'uses' =>'HopitalController@getServicesData']);
        });

        Route::get('/services/{service}/edit', 'HopitalController@editservice');
        Route::get('/services/{service}/destroy', 'HopitalController@destroyservice');
        Route::post('/services/update', 'HopitalController@updateservice');

/*
        Route::get('/admin/{admin}/edit', 'HopitalController@editadmin');
        Route::get('/admins/{admin}/destroy', 'HopitalController@destroyadmin');
        Route::post('/admins/update', 'HopitalController@updateadmin');

*/


        Route::prefix('{hopital}/services')->group(function() {
            Route::get('/data',['as' => 'administration.services.data' , 'uses' =>'HopitalController@getServicesData']);
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

    Route::prefix('/station')->group(function() {

        Route::get('/data',['as' => 'administration.station.data' , 'uses' =>'StationsController@getStationsData']);

        Route::get('/', 'StationsController@index');
        Route::get('/create', 'StationsController@create');
        Route::get('{station}', 'StationsController@show');
        Route::post('/store', 'StationsController@store');
        Route::post('/storeambulance', 'StationsController@storeambulance');
        Route::post('/storeadmin', 'StationsController@storeadmin');
        Route::get('{station}/edit', 'StationsController@edit');
        Route::post('/update', 'StationsController@update');
        Route::get('{station}/destroy', 'StationsController@destroy');
        Route::get('/ambulances/{ambulance}/destroy', 'StationsController@destroyambulance');
        Route::get('ambulances/{ambulance}/edit', 'StationsController@editambulance');


        /* Route::prefix('{station}/admin')->group(function() {
             Route::get('/data',['as' => 'administration.stationadmin.data' , 'uses' =>'StationController@getAdminData']);
         });*/


        Route::prefix('{station}/ambulances')->group(function() {
            Route::get('/data',['as' => 'administration.ambulances.data' , 'uses' =>'StationsController@getAmbulancesData']);
            Route::post('/update', 'HopitalController@updateservice');

        });



    });


});


Route::prefix('/hopital')->group(function() {


        Route::get('/', 'HopitalAdminController@index');

        Route::prefix('/interventions')->group(function() {
            Route::get('/data',['as' => 'administration.intervention.data' , 'uses' =>'InterventionsController@getInterventionData']);
            Route::get('/', 'InterventionsController@index');
            Route::get('/{intervention}', 'InterventionsController@show');
            Route::get('/{intervention}/edit', 'InterventionsController@edit');

            Route::post('/admission', 'InterventionsController@admission');
            Route::post('/libirer', 'InterventionsController@libirer');

            Route::post('/rapport/store', 'RapportsController@store');
            Route::delete('/rapport/{rapport}/destroy', 'RapportsController@destroy');





        });





});




Route::get('test', function () {
    event(new App\Events\InterventionSent('Someone'));
    return "Event has been sent!";
});

Route::get('/markAsRead', function () {
    App\Hopital::findOrFail(App\Role::find(2)->users()->where('user_id',Auth::user()->id)->first()->pivot->post_id)->unreadNotifications->markAsRead();
});







Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
