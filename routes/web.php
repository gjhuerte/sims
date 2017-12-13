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

	Route::get('inventory/supply/rsmi','RSMIController@rsmi');
	Route::get('inventory/supply/rsmi/{month}','RSMIController@rsmiPerMonth');
	Route::get('inventory/supply/rsmi/total/bystocknumber/{month}','RSMIController@rsmiByStockNumber');

	Route::get('rsmi/months','RSMIController@getAllMonths');

	Route::get('rsmi/{date}/print','RSMIController@print');

	Route::get('rsmi','RSMIController@index');

	Route::get('rsmi/{date}','RSMIController@getIssued');

	Route::get('rsmi/{date}/recapitulation','RSMIController@getRecapitulation');

	Route::get('report/fundcluster','ReportsController@getFundClusterView');

	Route::get('report/ris/{college}','ReportsController@getRISPerCollege');
	Route::get('report/fundcluster','ReportsController@fundcluster');

	Route::get('dashboard','DashboardController@index');

	Route::get('inventory/supply/ledgercard/{type}/computecost','LedgerCardController@computeCost');

	/*
	|
	| Supply Inventory Modules
	|
	*/
	Route::resource('inventory/supply','SupplyInventoryController');
	// return all supply stock number
	Route::get('get/inventory/supply/stocknumber/all','StockCardController@getAllStockNumber');
	// return stock number for autocomplete
	Route::get('get/inventory/supply/stocknumber','SupplyInventoryController@show');

	/*
	|
	| Office Modules
	|
	*/
	Route::get('get/office/code/all','OfficeController@getAllCodes');

	Route::get('get/office/code','OfficeController@show');

	Route::get('get/purchaseorder/all','PurchaseOrderController@show');

	Route::get('get/receipt/all','ReceiptController@show');

	Route::resource('maintenance/supply','SupplyController');

	Route::resource('maintenance/office','OfficeController');

	Route::resource('maintenance/unit','UnitsController');

	Route::resource('maintenance/supplier','SuppliersController');

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

	Route::middleware(['amo'])->group(function(){

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

	Route::middleware(['accounting'])->group(function(){

		Route::get('records/uncopied','LedgerCardController@showUncopiedRecords');
		Route::post('records/copy','LedgerCardController@copy');

		Route::get('inventory/supply/ledgercard/batch/form/accept',[
			'as' => 'supply.ledgercard.batch.accept.form',
			'uses' => 'LedgerCardController@batchAcceptForm'
		]);

		Route::get('inventory/supply/ledgercard/batch/form/release',[
			'as' => 'supply.ledgercard.batch.release.form',
			'uses' => 'LedgerCardController@batchReleaseForm'
		]);

		Route::post('inventory/supply/ledgercard/batch/accept',[
			'as' => 'supply.ledgercard.batch.accept',
			'uses' => 'LedgerCardController@batchAccept'
		]);

		Route::post('inventory/supply/ledgercard/batch/release',[
			'as' => 'supply.ledgercard.batch.release',
			'uses' => 'LedgerCardController@batchRelease'
		]);

		Route::get('inventory/supply/{id}/ledgercard/release','LedgerCardController@releaseForm');

		Route::get('inventory/supply/{id}/ledgercard/print','LedgerCardController@printLedgerCard');

		Route::get('inventory/supply/{id}/ledgercard/printSummary','LedgerCardController@printSummaryLedgerCard');

		Route::get('inventory/supply/ledgercard/print','LedgerCardController@printAllLedgerCard');

		Route::resource('inventory/supply.ledgercard','LedgerCardController');


	});

	Route::middleware(['admin'])->group(function(){
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
		Route::get('request/{id}/approve','RequestController@getApproveForm');
		Route::put('request/{id}/approve',[
			'as' => 'request.approve',
			'uses' => 'RequestController@approve'
		]);
		Route::put('request/{id}/disapprove','RequestController@disapprove');
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

Auth::routes();
