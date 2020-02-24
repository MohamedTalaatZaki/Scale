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

use App\Models\Production\TransportLine;
use Carbon\Carbon;

Route::get('/', function () {
    return view('layout.main');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/manager-index', 'HomeController@managerIndex')->name('managerHome');

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
    Route::get('security/print' , 'Security\TransportsController@print')->name('printLabels');
    Route::resource('security/queue' , 'Security\QueueController')->except('index');
    Route::get('security/trucks/queue-edit' , 'Security\QueueController@editQueueIndex')->name('edit-queue.index');
    Route::post('security/reorder-trucks-queue' , 'Security\QueueController@reorderQueue')->name('reorder-trucks-queue');

    Route::resource('security/blocked-drivers' , 'Security\BlockedDriversController');

    Route::resource('qc/arrived-trucks' , 'QC\ArrivedTrucksController');
    Route::resource('qc/samples-test' , 'QC\SamplesTestController');

    Route::resource('production/truck-summary' , 'Production\TruckSummaryController');

    Route::resource('production/production-process' , 'Production\ProductionProcessController');
    Route::post('production/production-process-start' , 'Production\ProductionProcessController@startProcess')->name('startProcess');
    Route::get('production/production-process-transfer' , 'Production\ProductionProcessController@transferLine')->name('transferLine');
    Route::post('production/production-process-finish' , 'Production\ProductionProcessController@finishProcess')->name('finishProcess');

    Route::resource('production/scrap-process' , 'Production\ScrapProcessController');
    Route::post('production/scrap-process-start' , 'Production\ScrapProcessController@startProcess')->name('scrapStartProcess');
    Route::get('production/scrap-process-transfer' , 'Production\ScrapProcessController@transferLine')->name('scrapTransferLine');
    Route::post('production/scrap-process-finish' , 'Production\ScrapProcessController@finishProcess')->name('scrapFinishProcess');

    Route::resource('production/finish-process' , 'Production\FinishProcessController');
    Route::post('production/finish-process-start' , 'Production\FinishProcessController@startProcess')->name('finishStartProcess');
    Route::get('production/finish-process-transfer' , 'Production\FinishProcessController@transferLine')->name('finishTransferLine');
    Route::post('production/finish-process-finish' , 'Production\FinishProcessController@finishProcess')->name('finishFinishProcess');

    Route::get('change-theme' , 'MasterData\UsersController@theme')->name('change-theme');
    Route::get('change-lang' , 'MasterData\UsersController@lang')->name('change-lang');
    Route::post('change-acc-info' , 'MasterData\UsersController@changeAccInfo')->name('users.change-acc-info');
    Route::get('master-data/supplier/items/{id}' , 'MasterData\ItemsController@supplierItems')->name('suppliers.items');
    Route::get('security/transports-in-process' , 'Security\TransportsController@inProcess')->name('transports.inProcess');
    Route::post('security/transports-check-out' , 'Security\TransportsController@checkOut')->name('transports.checkOut');
    Route::post('security/cancel' , 'Security\TransportsController@cancel')->name('transports.cancel');


    /*
     * AJAX Routes
     */
    Route::get('cities' , 'MasterData\CitiesController@getGovernorateCities')->name('getGovernorateCities');
    Route::get('centers' , 'MasterData\CentersController@getCityCenters')->name('getCityCenters');
    Route::get('getSupplierItemGroups' , 'MasterData\SuppliersController@getSupplierItemGroups')->name('getSupplierItemGroups');
    Route::get('toggleTruckStatus' , 'QC\ArrivedTrucksController@toggleTruckStatus')->name('toggleTruckStatus');

    Route::post('getLastBatch' , 'Production\ProductionProcessController@getLastBatch')->name('getLastBatch');
    Route::post('getSupplierItemByGroup' , 'Production\ProductionProcessController@getSupplierItemByGroup')->name('getSupplierItemByGroup');
    Route::post('getScrapSupplierItemByGroup' , 'Production\ScrapProcessController@getSupplierItemByGroup')->name('getScrapSupplierItemByGroup');

    Route::post('getFinishSupplierItemByGroup' , 'Production\FinishProcessController@getSupplierItemByGroup')->name('getFinishSupplierItemByGroup');

    Route::post('checkBlockedDriver' , 'Security\BlockedDriversController@checkIfBlocked')->name('checkIfBlocked');
    Route::post('suppliersItemGroup' , 'HomeController@getSuppliersAndItemGroupByItemTypePrefix')->name('dashboard.suppliersItemGroup');
});
Route::get('security/queue' , 'Security\QueueController@index')->name('queue.index');
Route::get('trucks-scale' , "Scale\TrucksScaleController@index")->name('trucks-scale.index');
Route::post('trucks-scale-check-barcode' , "Scale\TrucksScaleController@checkBarcode")->name('checkBarcode');
Route::post('trucks-scale-weight' , "Scale\TrucksScaleController@saveTruckScaleWeight")->name('trucks-scale.weight');

//Reports
Route::get('getScalePrintOutRpt/{transport_id}', 'ReportsController@getScalePrintOutRpt')->name('scale-printout-rpt.index');
Route::get('getQcLabelRpt/{transport_id}', 'ReportsController@getQcLabelRpt')->name('qc-label-rpt.index');
Route::get('getQcAnalysisRpt/{test_id}', 'ReportsController@getQcAnalysisRpt')->name('qc-analysis-rpt.index');


Auth::routes();

Route::get('test' , function (){
//    $transportDetail = (object) ['id' => 100];
//
//    $weight =   '200';
//    $transportDetailExist = TransportLine::query()
//        ->where('transport_detail_id' , $transportDetail->id)
//        ->whereNotNull('weight_out_date')
//        ->exists();
//
//    $NewTransportDetail = TransportLine::query()
//        ->where('transport_detail_id' , $transportDetail->id)
//        ->exists();
//
//    if($transportDetailExist || ! $NewTransportDetail) {
//        TransportLine::query()->create([
//            'transport_detail_id'   =>  $transportDetail->id,
//            'weight_in'   =>  $weight,
//            'weight_in_date'   =>  Carbon::now(),
//        ]);
//    }
//    try{
//        TransportLine::query()->create([
//            'transport_detail_id'   =>  333
//        ]);
//        TransportLine::query()->create([
//            'transport_detail_id'   =>  333
//        ]);
//    } catch (Exception $exception){}

});
