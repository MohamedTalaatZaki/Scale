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
});
Route::get('item_type/{en_name}',function($en_name){
  return App\Models\Items\ItemType::where('en_name',$en_name)->first();
});

Route::get('supplier/{en_name}',function($en_name){
  return App\Models\Supplier\Supplier::where('en_name',$en_name)->with('items')->first();
});

Route::get('item/{en_name}',function($sap_code){
  return App\Models\Items\Item::where('sap_code',$sap_code)->first();
});
Route::get('scale/{code}',function($code){
  return App\Models\Scales\Scale::where('code',$code)->first();
});

Route::get('qc-test/{id}',function($id){
  return App\Models\QC\QcTestHeader::with('details')->find($id);
});

Route::get('qc_test/{en_name}',function($en_name){
  return App\Models\QC\QcTestHeader::where('en_name',$en_name)->with('details')->first();
});
