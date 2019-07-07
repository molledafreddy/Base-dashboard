<?php
/**
 * Batch Route Management
 **/

Route::get('posts', [
	'uses' => 'Admin\PostController@index',
	'as' => 'posts.index',
]);

Route::post('posts/store', [
	'uses' => 'Admin\PostController@store',
	'as' => 'posts.store',
]);

Route::put('posts/update/{id}', [
	'uses' => 'Admin\PostController@update',
	'as' => 'posts.update',
]);

Route::match(['get', 'post', 'put'], '/posts/{action}/{id?}', [
	'uses' => 'Admin\PostController@handler',
	'as' => 'posts.async',
]);

//tags rutas
Route::get('tags', [
	'uses' => 'Admin\TagController@index',
	'as' => 'tags.index',
]);

Route::put('tags/update/{id}', [
	'uses' => 'Admin\TagController@update',
	'as' => 'tags.update',
]);

Route::post('tags/store', [
	'uses' => 'Admin\TagController@store',
	'as' => 'tags.store',
]);

Route::match(['get', 'post', 'put'], '/tags/{action}/{id?}', [
	'uses' => 'Admin\TagController@handler',
	'as' => 'tags.async',
]);

?>
