<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth::routes();
// Route::post('login', 'Auth\LoginController@doLogin');

// Route::post('/logout', 'Auth\LoginController@logout');
// Route::post('validEmail','Auth\LoginController@validEmail');
// Route::post('password/reset','Auth\ResetPasswordController@reset');


// Route::group(['prefix' => 'auth'], function () {
//     Route::post('login', 'Admin\AuthController@login');
//     Route::post('signup', 'Admin\AuthController@signup');
  
//     Route::group(['middleware' => 'auth:api'], function() {
//         Route::get('logout', 'Admin\AuthController@logout');
//         // Route::post('logout', 'Auth\LoginController@logout');
//         Route::get('user', 'Admin\AuthController@user');
//     });
// });

// Route::get('/home', 'HomeController@index')->middleware(['auth','admin'])->name('home');
// // ->middleware(['auth','admin']) 'defaultLang',
// Route::prefix('admin')->group(function () {
// 	// return "llego";
//     Route::view('/', 'home')->name('admin');
//     Route::view('/{any}', 'home')->name('adminChilds')->where('any', '.*');
// });

