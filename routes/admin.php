<?php

Route::get('/panel', [
	'uses' => 'Admin\HomeController@index',
	'as' => 'admin.index',
]);

Route::get('/usuarios', [
	'uses' => 'Admin\UsersController@index',
	'as' => 'admin.users.index',
]);

Route::match(['get', 'post', 'put'], '/usuarios/{action}/{id?}', [
	'uses' => 'Admin\UsersController@handler',
	'as' => 'admin.users.async',
]);

Route::get('/getDataTablesUser/{type}', [
	'uses' => 'Admin\UsersController@getDataTables',
	'as' => 'admin.users.datatables',
]);

Route::get('/verificacion_usuarios', [
	'uses' => 'Admin\UserActivationController@index',
	'as' => 'admin.verification.index',
]);

Route::match(['get', 'post', 'put'], '/verificacion_usuarios/{action}/{id?}', [
	'uses' => 'Admin\UserActivationController@handler',
	'as' => 'admin.verification.async',
]);

Route::get('/getDataTablesVerificarion/{type}', [
	'uses' => 'Admin\UserActivationController@getDataTables',
	'as' => 'admin.verification.datatables',
]);

require __DIR__ . '/admin/loadContentRoute.php';
require __DIR__ . '/admin/parametersRoute.php';
require __DIR__ . '/admin/paymentDataRoute.php';
require __DIR__ . '/admin/testimonialRoute.php';
require __DIR__ . '/admin/transactionRoute.php';
require __DIR__ . '/admin/tracingRoute.php';
require __DIR__ . '/admin/chatRoute.php';
require __DIR__ . '/admin/AccountTypeRoute.php';
require __DIR__ . '/admin/AccountRoute.php';
require __DIR__ . '/admin/pendingOperationsRoute.php';
require __DIR__ . '/admin/messageRoute.php';
require __DIR__ . '/admin/sponsorsRoute.php';
require __DIR__ . '/admin/categoriesRoute.php';
require __DIR__ . '/admin/postsRoute.php';
require __DIR__ . '/admin/commentRoute.php';
require __DIR__ . '/admin/ManagementEmailRoute.php';
require __DIR__ . '/admin/pendingTransactionRoute.php';
require __DIR__ . '/admin/mailDeliveryRoute.php';
require __DIR__ . '/admin/subscribersRoutes.php';
