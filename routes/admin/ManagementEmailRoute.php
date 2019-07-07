<?php
/**
 * Batch Route Management
 **/

Route::get('management-email', [
	'uses' => 'Admin\ManagementEmailController@index',
	'as' => 'managementEmails.index',
]);


Route::match(['get', 'post', 'put'], '/management-email/{action}/{id?}', [
	'uses' => 'Admin\ManagementEmailController@handler',
	'as' => 'managementEmails.async',
]);

?>