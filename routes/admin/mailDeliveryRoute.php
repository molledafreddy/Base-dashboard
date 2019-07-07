<?php
/**
 * Batch Route Management
 **/


Route::get('mail-delivery', [
	'uses' => 'Admin\MailDeliveryController@index',
	'as' => 'admin.mailDelivery.index',
]);

Route::post('message/store', [
	'uses' => 'Admin\MessageController@store',
	'as' => 'admin.message.store',
]);

Route::match(['get','post','put'],'/mail-delivery/{action}/{id?}', [
	'uses' => 'Admin\MailDeliveryController@handler',
	'as' => 'admin.mail-delivery.async',
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
