<?php
/**
 * Batch Route Management
 **/

Route::get('transaction-verification', [
	'uses' => 'Admin\TransactionVerificationController@index',
	'as' => 'transaction-verification.index',
]);

Route::get('transaction-search', [
	'uses' => 'Admin\TransactionVerificationController@search',
	'as' => 'transaction.search',
]);
Route::get('transaction-pdf/{id}', [
	'uses' => 'Admin\TransactionVerificationController@pdf',
	'as' => 'transaction.pdf',
]);
Route::get('emailTransaction/{id}', [
	'uses' => 'Admin\TransactionVerificationController@email_user',
	'as' => 'email_user',
]);

Route::post('transaction-verification/store', [
	'uses' => 'Admin\TransactionVerificationController@store',
	'as' => 'transaction-verification.store',
]);

Route::post('transaction-verification/email', [
	'uses' => 'Admin\TransactionVerificationController@store_email',
	'as' => 'transaction.email',
]);

Route::put('transaction-verification/update/{id}', [
	'uses' => 'Admin\TransactionVerificationController@update',
	'as' => 'transaction-verification.update',
]);

Route::match(['get', 'post', 'put'], '/transaction-verification/{action}/{id?}', [
	'uses' => 'Admin\TransactionVerificationController@handler',
	'as' => 'transaction-verification.async',
]);

?>
