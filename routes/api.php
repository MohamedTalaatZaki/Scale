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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('user/{username}',function($username){
  return App\User::where('user_name',$username)->with('roles')->first();
});

Route::get('governorate/{en_name}',function($en_name){
  return App\Models\Governorate::where('en_name',$en_name)->first();
});

Route::get('city/{en_name}',function($en_name){
  return App\Models\City::where('en_name',$en_name)->first();
});

Route::get('center/{en_name}',function($en_name){
  return App\Models\Center::where('en_name',$en_name)->with('city')->first();
Route::get('item_type/{en_name}',function($en_name){
  return App\Models\Items\ItemType::where('en_name',$en_name)->first();
});
