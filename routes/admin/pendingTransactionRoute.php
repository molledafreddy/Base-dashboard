<?php
/**
 * Batch Route Management
 **/

Route::get('pending-transaction', [
	'uses' => 'Admin\PendingTransactionsController@index',
	'as' => 'pending-transaction.index',
]);

Route::post('pending-transaction/store', [
	'uses' => 'Admin\PendingTransactionsController@store',
	'as' => 'pending-transaction.store',
]);

Route::post('pending-transaction/email', [
	'uses' => 'Admin\PendingTransactionsController@store_email',
	'as' => 'transaction.email',
]);

Route::post('pending-transaction/verify/{id}', [
	'uses' => 'Admin\PendingTransactionsController@verify',
	'as' => 'pending-transaction.verify',
]);


Route::put('pending-transaction/update/{id}', [
	'uses' => 'Admin\PendingTransactionsController@update',
	'as' => 'pending-transaction.update',
]);

Route::match(['get', 'post', 'put'], '/pending-transaction/{action}/{id?}', [
	'uses' => 'Admin\PendingTransactionsController@handler',
	'as' => 'pending-transaction.async',
]);

?>
