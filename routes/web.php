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
Route::get('test' , function(){
    dd('test');
});
Route::get('/', function () {
    return view('layout.main');
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

    Route::get('change-theme' , 'MasterData\UsersController@theme')->name('change-theme');
    Route::post('change-acc-info' , 'MasterData\UsersController@changeAccInfo')->name('users.change-acc-info');

});


Auth::routes();


