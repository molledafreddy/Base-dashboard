<?php
/**
 * Batch Route Management
 **/

Route::get('sponsors', [
	'uses' => 'Admin\SponsorController@index',
	'as' => 'sponsors.index',
]);

Route::post('sponsors/store', [
	'uses' => 'Admin\SponsorController@store',
	'as' => 'sponsors.store',
]);

Route::put('sponsors/update/{id}', [
	'uses' => 'Admin\SponsorController@update',
	'as' => 'sponsors.update',
]);

Route::match(['get', 'post', 'put'], '/sponsors/{action}/{id?}', [
	'uses' => 'Admin\SponsorController@handler',
	'as' => 'sponsors.async',
]);

?>