<?php
/**
 * Batch Route Management
 **/

Route::get('seguimiento', [
	'uses' => 'Admin\TracingController@index',
	'as' => 'tracing.index',
]);
Route::get('seguimiento/nota/{id}', [
	'uses' => 'Admin\TracingController@note',
	'as' => 'note',
]);

Route::post('seguimiento/nota/store', [
	'uses' => 'Admin\TracingController@store_note',
	'as' => 'tracing.note.store',
]);
Route::post('seguimiento/email', [
	'uses' => 'Admin\TracingController@store_email',
	'as' => 'tracing.email',
]);

Route::get('emailTransaction/{id}', [
	'uses' => 'Admin\TracingController@email_user',
	'as' => 'tracing.email_user',
]);


Route::match(['get', 'post', 'put'], '/seguimiento/{action}/{id?}', [
	'uses' => 'Admin\TracingController@handler',
	'as' => 'tracing.async',
]);

?>
