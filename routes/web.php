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

Route::get('/', function () {
    return view('layout.main');
});

Route::get('test' , function(){
    $x  =   \App\Models\Security\Transports::query()->RawOrder()->get();
    $y  =   \App\Models\Security\Transports::query()->ScrapOrder('DESC')->select('order')->first();
    $z  =   \App\Models\Security\Transports::query()->FinishOrder()->get();
    dd($x , $y , $z);
});
Route::middleware(['auth'])->group(function (){
    Route::get('/', 'HomeController@index')->name('home');

    Route::resource('master-data/roles' , 'MasterData\RolesController');
    Route::resource('master-data/users' , 'MasterData\UsersController');
    Route::resource('master-data/governorates' , 'MasterData\GovernoratesController');
    Route::resource('master-data/cities' , 'MasterData\CitiesController');
    Route::resource('master-data/centers' , 'MasterData\CentersController');
    Route::resource('master-data/items/item-group' , 'MasterData\ItemGroupController');
    Route::resource('master-data/items/item-types' , 'MasterData\ItemTypesController');
    Route::resource('master-data/items/items' , 'MasterData\ItemsController');
    Route::resource('master-data/suppliers' , 'MasterData\SuppliersController');
    Route::resource('master-data/scales' , 'MasterData\ScalesController');
    Route::resource('master-data/qc-elements' , 'MasterData\QcElementsController');
    Route::resource('master-data/qc-test-headers' , 'MasterData\QcTestHeaderController');


    Route::resource('security/transports' , 'Security\TransportsController');
    Route::get('print' , 'Security\TransportsController@print')->name('printLabels');
    Route::resource('security/queue' , 'Security\QueueController');

    Route::resource('qc/arrived-trucks' , 'QC\ArrivedTrucksController');
    Route::resource('qc/samples-test' , 'QC\SamplesTestController');

    Route::get('change-theme' , 'MasterData\UsersController@theme')->name('change-theme');
    Route::get('change-lang' , 'MasterData\UsersController@lang')->name('change-lang');
    Route::post('change-acc-info' , 'MasterData\UsersController@changeAccInfo')->name('users.change-acc-info');
    Route::get('master-data/supplier/items/{id}' , 'MasterData\ItemsController@supplierItems')->name('suppliers.items');
    Route::get('security/transports-in-process' , 'Security\TransportsController@inProcess')->name('transports.inProcess');
    Route::get('security/transports-check-out' , 'Security\TransportsController@checkOut')->name('transports.checkOut');
    Route::get('security/cancel' , 'Security\TransportsController@cancel')->name('transports.cancel');

    /*
     * AJAX Routes
     */
    Route::get('cities' , 'MasterData\CitiesController@getGovernorateCities')->name('getGovernorateCities');
    Route::get('centers' , 'MasterData\CentersController@getCityCenters')->name('getCityCenters');
    Route::get('getSupplierItemGroups' , 'MasterData\SuppliersController@getSupplierItemGroups')->name('getSupplierItemGroups');
    Route::get('toggleTruckStatus' , 'QC\ArrivedTrucksController@toggleTruckStatus')->name('toggleTruckStatus');
});

Auth::routes();



