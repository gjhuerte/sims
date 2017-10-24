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

Route::middleware(['auth'])->group(function(){

	Route::resource('/', 'HomeController');

	Route::get('inventory/supply/rsmi','RSMIController@rsmi');
	Route::get('inventory/supply/rsmi/{month}','RSMIController@rsmiPerMonth');
	Route::get('inventory/supply/rsmi/total/bystocknumber/{month}','RSMIController@rsmiByStockNumber');
	Route::get('get/supply/inventory/stockcard/months/all','RSMIController@getAllMonths');
	Route::get('logout', 'Auth\LoginController@logout');

	Route::get('report/rsmi','ReportsController@getRSMIView');

	Route::get('report/fundcluster','ReportsController@getFundClusterView');

	Route::get('report/ris/{college}','ReportsController@getRISPerCollege');
	Route::get('report/fundcluster','ReportsController@fundcluster');
	/*
	*
	* Supply Inventory Modules
	*/
	// supply modules
	Route::resource('inventory/supply','SupplyInventoryController');
	// returns supply balance based on input supply
	Route::get('get/supply/{supply}/balance','SupplyInventoryController@getSupplyWithRemainingBalance');
	// return all supply stock number
	Route::get('get/inventory/supply/stocknumber/all','StockCardController@getAllStockNumber');
	// return stock number for autocomplete
	Route::get('get/inventory/supply/stocknumber','StockCardController@getSupplyStockNumber');

	/*
	*
	* Office Modules
	*/
	Route::get('get/office/code/all','OfficeController@getAllCodes');

	Route::get('get/office/code','OfficeController@getOfficeCode');

	Route::get('get/purchaseorder/all','PurchaseOrderController@getAllPurchaseOrder');

	Route::resource('maintenance/supply','SupplyController');

	Route::resource('maintenance/office','OfficeController');

	Route::post('get/supplyledger/checkifexisting',[
		'as' => 'supplyledger.checkifexisting',
		'uses' => 'SupplyLedgerController@checkIfSupplyLedgerExists'
	]);

	Route::post('get/supplyledger/copy',[
		'as' => 'supplyledger.copy',
		'uses' => 'SupplyLedgerController@release'
	]);

	Route::put('purchaseorder/supply/{id}','PurchaseOrderSupplyController@update');
	Route::resource('purchaseorder','PurchaseOrderController');

	Route::get('settings',['as'=>'settings.edit','uses'=>'SessionsController@edit']);

	Route::post('settings',['as'=>'settings.update','uses'=>'SessionsController@update']);

});

Route::middleware(['auth','amo'])->group(function(){

	Route::get('inventory/supply/stockcard/batch/form/accept',[
			'as' => 'supply.stockcard.batch.accept.form',
			'uses' => 'StockCardController@batchAcceptForm'
	]);

	Route::get('inventory/supply/stockcard/batch/form/release',[
			'as' => 'supply.stockcard.batch.release.form',
			'uses' => 'StockCardController@batchReleaseForm'
	]);

	Route::post('inventory/supply/stockcard/batch/accept',[
			'as' => 'supply.stockcard.batch.accept',
			'uses' => 'StockCardController@batchAccept'
	]);

	Route::post('inventory/supply/stockcard/batch/release',[
			'as' => 'supply.stockcard.batch.release',
			'uses' => 'StockCardController@batchRelease'
	]);

	Route::get('inventory/supply/{id}/stockcard/release','StockCardController@releaseForm');

	Route::get('inventory/supply/{id}/stockcard/print','StockCardController@printStockCard');

		Route::get('inventory/supply/stockcard/print','StockCardController@printAllStockCard');

	Route::resource('inventory/supply.stockcard','StockCardController');

	Route::get('request/{id}/release',[
		'as' => 'request.release',
		'uses' => 'RequestController@releaseView'
	]);

});

Route::middleware(['auth','accounting'])->group(function(){

	Route::get('inventory/supply/supplyledger/batch/form/accept',[
			'as' => 'supply.supplyledger.batch.accept.form',
			'uses' => 'SupplyLedgerController@batchAcceptForm'
	]);

	Route::get('inventory/supply/supplyledger/batch/form/release',[
			'as' => 'supply.supplyledger.batch.release.form',
			'uses' => 'SupplyLedgerController@batchReleaseForm'
	]);

	Route::post('inventory/supply/supplyledger/batch/accept',[
			'as' => 'supply.supplyledger.batch.accept',
			'uses' => 'SupplyLedgerController@batchAccept'
	]);

	Route::post('inventory/supply/supplyledger/batch/release',[
			'as' => 'supply.supplyledger.batch.release',
			'uses' => 'SupplyLedgerController@batchRelease'
	]);

	Route::get('inventory/supply/{id}/supplyledger/release','SupplyLedgerController@releaseForm');

	Route::get('inventory/supply/{id}/supplyledger/print','SupplyLedgerController@printSupplyLedger');

	Route::get('inventory/supply/supplyledger/print','SupplyLedgerController@printAllSupplyLedger');

	Route::resource('inventory/supply.supplyledger','SupplyLedgerController');


});

Route::middleware(['auth','admin'])->group(function(){
	Route::get('audittrail','AuditTrailController@index');
	Route::resource('account','AccountsController');
	Route::post('account/password/reset','AccountsController@resetPassword');

	Route::put('account/access/update',[
			'as' => 'account.accesslevel.update',
			'uses' => 'AccountsController@changeAccessLevel'
 		]);
});

Route::middleware(['auth','offices'])->group(function(){

	Route::get('request/{id}/print','RequestController@print');
	Route::resource('request','RequestController');
});

Auth::routes();
