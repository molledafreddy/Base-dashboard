<?php
/**
 * Batch Route Management
 **/

Route::get('categories', [
	'uses' => 'Admin\CategoryController@index',
	'as' => 'categories.index',
]);

Route::post('categories/store', [
	'uses' => 'Admin\CategoryController@store',
	'as' => 'categories.store',
]);

Route::put('categories/update/{id}', [
	'uses' => 'Admin\CategoryController@update',
	'as' => 'categories.update',
]);

Route::match(['get', 'post', 'put'], '/categories/{action}/{id?}', [
	'uses' => 'Admin\CategoryController@handler',
	'as' => 'categories.async',
]);

?>