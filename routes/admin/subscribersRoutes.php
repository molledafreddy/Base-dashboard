<?php
/**
 * Batch Route Management
 **/


Route::get('subscriptores', [
	'uses' => 'Admin\SubscriberController@index',
	'as' => 'admin.subscribers.index',
]);

Route::post('subscriptores/store', [
	'uses' => 'Admin\SubscriberController@store',
	'as' => 'admin.subscribers.store',
]);

Route::put('subscriptores/update/{id}', [
	'uses' => 'Admin\SubscriberController@update',
	'as' => 'admin.subscribers.update',
]);

Route::match(['get','post','put'],'/subscriptores/{action}/{id?}', [
	'uses' => 'Admin\SubscriberController@handler',
	'as' => 'admin.subscribers.async',
]);

?>
