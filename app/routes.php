<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});


Route::group(array(
	'prefix' => '',
	'namespace' => 'Admin',
	// 'before' => 'auth',
), function(){

	Route::controller('invoice','InvoiceController');
	Route::controller('kwitansi','KwitansiController');
	Route::controller('receipt','ReceiptController');
	Route::controller('client','ClientController');
	Route::controller('company','CompanyController');
	Route::controller('contract','ContractController');
});
