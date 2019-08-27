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

Route::middleware(['auth'])->group(function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');

    Route::resource('master-data/roles' , 'MasterData\RolesController');
    Route::resource('master-data/users' , 'MasterData\UsersController');


    Route::get('logout' , function (){
        Auth::logout();
        return view('auth.login');
    });
    Route::get('change-theme' , 'MasterData\UsersController@theme')->name('change-theme');
});


Auth::routes();


