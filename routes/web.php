<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->middleware(['defaultLang','auth','admin']);

Route::get('lang/{lang}', function($lang){
     session(['lang' => $lang]);
        return \Redirect::back();
})->where([
    'lang' => 'en|es'
]);

Auth::Routes();

Route::post('/logout', 'Auth\LoginController@logout');
Route::post('login', 'Auth\LoginController@doLogin');
// Route::get('login','Auth\LoginController@showLoginForm')->name('login');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset','Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');
// ->middleware(['auth','admin']) 'defaultLang',
Route::prefix('admin')->group(function () {
    Route::view('/', 'home')->name('admin');
    Route::view('/{any}', 'home')->name('adminChilds')->where('any', '.*');
});


Route::prefix('admin-panel')->group(function () {

    /**
     * users
     */
	Route::get('user',['as' => 'user.index','uses' => 'Admin\UserController@index']);    

    Route::get('userList',['as' => 'user.list','uses' => 'Admin\UserController@userList']);

    Route::get('userGroupList',['as' => 'userGroup.list','uses' => 'Admin\UserController@userGroupList']);

    Route::get('user-edit/{id}',['as' => 'user.show','uses' => 'Admin\UserController@getUser']);
    
    Route::post('user', ['name' => 'admin.user.store', 'uses' => 'Admin\UserController@store']);

    Route::put('user/{id}', ['name' => 'admin.user.update', 'uses' => 'Admin\UserController@update']);

    Route::delete('user/{id}', ['as' => 'api.user.delete', 'uses' => 'Admin\UserController@delete']);

    /**
     * settingGroups
     */
    Route::get('settingGroup', ['as' => 'api.settingGroup.index', 'uses' => 'Admin\SettingGroupController@index']);
    Route::post('settingGroup', ['as' => 'api.settingGroup.store', 'uses' => 'Admin\SettingGroupController@store']);

    Route::get('setting-group-edit/{id}',['as' => 'setting-group.show','uses' => 'Admin\UserController@getSettingGroup']);
    
    Route::put('settingGroup/{id}', ['as' => 'api.settingGroup.update', 'uses' => 'Admin\SettingGroupController@update']);
    Route::delete('settingGroup/{id}', ['as' => 'api.settingGroup.delete', 'uses' => 'Admin\SettingGroupController@delete']);

    /**
     * setting
     */
    Route::get('setting', ['as' => 'api.setting.index', 'uses' => 'Admin\SettingController@index']);
    Route::get('setting/{key}', ['as' => 'api.setting.show', 'uses' => 'Admin\SettingController@show']);
    Route::post('setting', ['as' => 'api.setting.store', 'uses' => 'Admin\SettingController@store']);
    Route::put('setting/{id}', ['as' => 'api.setting.update', 'uses' => 'Admin\SettingController@update']);
    Route::put('settingAll/{id}', ['as' => 'api.settingAll.update', 'uses' => 'Admin\SettingController@updateAll']);
    Route::delete('setting/{id}', ['as' => 'api.setting.delete', 'uses' => 'Admin\SettingController@delete']);
    Route::get('setting/color', ['as' => 'api.setting.color', 'uses' => 'Admin\SettingController@color']);

});



// Localization
Route::get('/js/lan.js', function () {
    $strings = Cache::remember('lan.js', 0, function () {
        $lang = config('app.locale');
        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name           = basename($file, '.php');
            $strings[$name] = require $file;
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');



Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
