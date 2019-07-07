<?php
/**
 * Batch Route Management
 **/


Route::get('message', [
	'uses' => 'Admin\MessageController@index',
	'as' => 'admin.message.index',
]);

Route::post('message/store', [
	'uses' => 'Admin\MessageController@store',
	'as' => 'admin.message.store',
]);


Route::match(['get','post','put'],'/message/{action}/{id?}', [
	'uses' => 'Admin\MessageController@handler',
	'as' => 'admin.message.async',
]);


Route::get('mensajes/obtener', [
	'uses' => 'Admin\MessageController@getMessages',
	'as' => 'admin.messages.get',
]);

Route::post('mensajes/agregar', [
	'uses' => 'Admin\MessageController@addMessage',
	'as' => 'admin.messages.add',
]);


?>
