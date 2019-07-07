<?php
/**
 * Batch Route Management
 **/

Route::get('pending', [
	'uses' => 'Admin\PendingOperationController@index',
	'as' => 'pending.index',
]);


Route::post('pending/store', [
	'uses' => 'Admin\PendingOperationController@store',
	'as' => 'pending.store',
]);

Route::put('pending/update/{id}', [
	'uses' => 'Admin\PendingOperationController@update',
	'as' => 'pending.update',
]);
Route::post('pending/approve', [
	'uses' => 'Admin\PendingOperationController@approve',
	'as' => 'pending.approve',
]);

Route::match(['get', 'post', 'put'], '/pending/{action}/{id?}', [
	'uses' => 'Admin\PendingOperationController@handler',
	'as' => 'pending.async',
]);

?>
