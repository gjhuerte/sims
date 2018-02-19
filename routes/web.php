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

	Route::get('/', 'HomeController@index');
	Route::get('settings',['as'=>'settings.edit','uses'=>'SessionsController@edit']);
	Route::post('settings',['as'=>'settings.update','uses'=>'SessionsController@update']);
	Route::get('logout', 'Auth\LoginController@logout');

	Route::get('dashboard','DashboardController@index');
	Route::get('inventory/supply/{type}/print', 'SupplyInventoryController@printMasterList');

	Route::get('inventory/supply/ledgercard/{type}/computecost','LedgerCardController@computeCost');

	/**
	 * supply inventory modules
	 */
	Route::get('inventory/supply/advancesearch','SupplyInventoryController@advanceSearch');
	Route::get('inventory/supply','SupplyInventoryController@index');

	/**
	 * computation for days to consume
	 * returns days to consume as return value
	 * add this first before other options
	 */
	Route::get('inventory/supply/{stocknumber}/compute/daystoconsume', 'StockCardController@estimateDaysToConsume');	
	Route::get('inventory/supply/{id}','SupplyInventoryController@getSupplyInformation');
	// return all supply stock number
	Route::get('get/inventory/supply/stocknumber/all','StockCardController@getAllStockNumber');
	// return stock number for autocomplete
	Route::get('get/inventory/supply/stocknumber','SupplyInventoryController@show');

	Route::get('request/{type}/count', 'RequestController@count');

	Route::middleware(['except-offices'])->group(function(){

		Route::get('rsmi', [
			'as' => 'rsmi.index',
			'uses' => 'RSMIController@index'
		]);

		Route::post('rsmi', [
			'as' => 'rsmi.store',
			'uses' => 'RSMIController@store'
		]);

		Route::get('report/fundcluster','ReportsController@getFundClusterView');

		Route::get('report/ris/{college}','ReportsController@getRISPerCollege');
		Route::get('report/fundcluster','ReportsController@fundcluster');

		Route::get('get/office/code/all','OfficeController@getAllCodes');

		Route::get('get/office/code','OfficeController@show');

		Route::get('get/purchaseorder/all','PurchaseOrderController@show');

		Route::get('get/receipt/all','ReceiptController@show');

		Route::get('maintenance/supply/print','SupplyController@print');

		Route::resource('maintenance/supply','SupplyController');

		Route::resource('maintenance/office','OfficeController');

		Route::resource('maintenance/unit','UnitsController');

		Route::resource('maintenance/supplier','SuppliersController');
		
		Route::resource('maintenance/department','DepartmentController');

		Route::get('maintenance/category/assign/{id}', 'CategoriesController@showAssign');
		Route::put('maintenance/category/assign/{id}', 'CategoriesController@assign');

		Route::resource('maintenance/category','CategoriesController');

		Route::get('uacs/months', 'UACSController@getAllMonths');
		Route::get('uacs', 'UACSController@getIndex');
		Route::get('uacs/{month}', 'UACSController@getUACS');

		Route::post('get/ledgercard/checkifexisting',[
			'as' => 'ledgercard.checkifexisting',
			'uses' => 'LedgerCardController@checkIfLedgerCardExists'
		]);

		Route::put('purchaseorder/supply/{id}','PurchaseOrderSupplyController@update');
		Route::get('purchaseorder/{id}/print','PurchaseOrderController@printPurchaseOrder');

		Route::resource('purchaseorder','PurchaseOrderController');

		Route::get('request/generate','RequestController@generate');

		Route::get('receipt/{receipt}/print','ReceiptController@printReceipt');

		Route::resource('receipt','ReceiptController');
	});

	Route::middleware(['amo-office'])->group(function(){
		Route::resource('inspection', 'InspectionController');
	});

	Route::middleware(['amo'])->group(function(){

		Route::get('inventory/supply/stockcard/accept',[
			'as' => 'supply.stockcard.accept.form',
			'uses' => 'StockCardController@create'
		]);

		Route::get('inventory/supply/stockcard/release',[
			'as' => 'supply.stockcard.release.form',
			'uses' => 'StockCardController@releaseForm'
		]);

		Route::post('inventory/supply/stockcard/create',[
			'as' => 'supply.stockcard.accept',
			'uses' => 'StockCardController@store'
		]);

		Route::post('inventory/supply/stockcard/release',[
			'as' => 'supply.stockcard.release',
			'uses' => 'StockCardController@release'
		]);

		Route::get('inventory/supply/{id}/stockcard/print','StockCardController@printStockCard');

		Route::get('inventory/supply/stockcard/print','StockCardController@printAllStockCard');

		Route::resource('inventory/supply.stockcard','StockCardController');

		Route::put('request/{id}/reset', 'RequestController@resetStatus');

		Route::get('request/{id}/accept','RequestController@getAcceptForm');
		
		Route::put('request/{id}/accept',[
			'as' => 'request.accept',
			'uses' => 'RequestController@accept'
		]);

		Route::get('request/{id}/release',[
			'as' => 'request.release',
			'uses' => 'RequestController@releaseView'
		]);

		Route::get('adjustment/{id}/print', 'AdjustmentsController@print');
		Route::get('adjustment/dispose', 'AdjustmentsController@dispose');
		Route::put('adjustment/return', [
			'as' => 'adjustment.dispose',
			'uses' => 'AdjustmentsController@destroy'
		]);
		Route::get('adjustment/return', 'AdjustmentsController@create');

		Route::resource('adjustment', 'AdjustmentsController');

		Route::resource('announcement', 'AnnouncementsController');

		Route::post('rsmi/{id}/submit', 'RSMIController@submit');

	});

	Route::middleware(['accounting'])->group(function(){

		Route::get('records/uncopied','LedgerCardController@showUncopiedRecords');
		Route::post('records/copy','LedgerCardController@copy');

		Route::get('inventory/supply/ledgercard/accept',[
			'as' => 'supply.ledgercard.accept.form',
			'uses' => 'LedgerCardController@create'
		]);

		Route::get('inventory/supply/ledgercard/release',[
			'as' => 'supply.ledgercard.release.form',
			'uses' => 'LedgerCardController@releaseForm'
		]);

		Route::post('inventory/supply/ledgercard/accept',[
			'as' => 'supply.ledgercard.accept',
			'uses' => 'LedgerCardController@store'
		]);

		Route::post('inventory/supply/ledgercard/release',[
			'as' => 'supply.ledgercard.release',
			'uses' => 'LedgerCardController@release'
		]);


		Route::get('inventory/supply/{id}/ledgercard/print','LedgerCardController@printLedgerCard');

		Route::get('inventory/supply/{id}/ledgercard/printSummary','LedgerCardController@printSummaryLedgerCard');

		Route::get('inventory/supply/ledgercard/print','LedgerCardController@printAllLedgerCard');

		Route::resource('inventory/supply.ledgercard','LedgerCardController');

		Route::resource('fundcluster','FundClusterController');

		Route::get('rsmi/{id}/receive', 'RSMIController@showReceive');
		
		Route::post('rsmi/{id}/receive', [
			'as' => 'rsmi.receive',
			'uses' => 'RSMIController@receive'
		]);

		Route::get('rsmi/{id}/summary', 'RSMIController@showSummary');
		
		Route::post('rsmi/{id}/summary', [
			'as' => 'rsmi.summary',
			'uses' => 'RSMIController@summary'
		]);

		Route::post('rsmi/{id}/apply', 'RSMIController@apply');

	});

	Route::middleware(['except-offices'])->group(function(){

		Route::get('rsmi/{id}', [
			'as' => 'rsmi.show',
			'uses' => 'RSMIController@show'
		]);

		Route::get('rsmi/{id}/print', 'RSMIController@print');
	});

	Route::middleware(['admin'])->group(function(){
		
		Route::get('sync', 'SyncController@getSync');
		Route::post('sync', 'SyncController@sync');

		Route::get('audittrail','AuditTrailController@index');
		Route::resource('account','AccountsController');
		Route::post('account/password/reset','AccountsController@resetPassword');
		Route::put('account/access/update',[
			'as' => 'account.accesslevel.update',
			'uses' => 'AccountsController@changeAccessLevel'
		]);
		Route::get('import','ImportController@index');
		Route::post('import','ImportController@store');
	});

	Route::middleware(['offices'])->group(function(){
		Route::get('request/{id}/print','RequestController@print');
		Route::get('request/{id}/cancel','RequestController@getCancelForm');
		Route::get('request/{id}/comments','RequestController@getComments');

		Route::post('request/{id}/comments','RequestController@postComments');
		Route::put('request/{id}/cancel',[
			'as' => 'request.cancel',
			'uses' => 'RequestController@cancel'
		]);
		Route::resource('request','RequestController');
	});

	Route::get('get/supply/stocknumber','SupplyInventoryController@show');


});

Route::get('hris/login', 'SessionsController@getHrisLogin');
Route::post('hris/login', 'SessionsController@hrisLogin');

Route::get('login', 'SessionsController@getLogin');
Route::post('login', 'SessionsController@login');
