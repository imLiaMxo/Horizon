<?php

use Illuminate\Support\Facades\Route;

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

/*
    General Routes
*/
Route::get('/', 'HomeController@index')->name('home');
Route::get('/servers', 'ServerController@index')->name('servers');

/*
    Authentication Routes
*/
Route::get('/login', 'Auth\LoginController@steam')->name('steam.login');
Route::get('/auth/user', 'Auth\LoginController@steamRedirect');
Route::get('/logout', 'Auth\LoginController@logout')->name('steam.logout');

/*
    Application Routes
*/

Route::get('/apply', 'ApplicationController@index')->name('apply')->middleware('auth');
Route::get('/apply/check', 'ApplicationController@check')->name('apply.check')->middleware('auth');
Route::post('/apply/post', 'ApplicationController@store')->name('applyPost')->middleware('auth');

/*
    Notifications
*/
Route::get('/notifications', 'NotificationsController@index')->name('notifications')->middleware('auth');
Route::get('/notifications/{id}', 'NotificationsController@read')->name('notifications.read')->middleware('auth');

/*
    Forum Routes
*/
Route::group(['prefix' => 'forums'], function () {
    // Home
    Route::get('/', 'Forums\ForumController')->name('forums.index');
    Route::get('/boards/{board}', 'Forums\BoardController')->name('forums.boards.show');
    Route::get('/boards/{board}/create', 'Forums\ThreadController@create')->name('forums.threads.create');

    Route::get('/threads/{thread}', 'Forums\ThreadController@show')->name('forums.threads.show');

});

/*
    Donation Routes
*/
Route::group(['prefix' => 'donate'], function() {
    Route::get('/', 'DonateController@index')->name('donate');
    Route::post('/charge', 'DonateController@charge')->name('donate.post');
    Route::get('/success', 'DonateController@success')->name('donate.success');
    Route::get('/error', 'DonateController@error')->name('donate.fail');
});

/*
    Admin Routes
*/
Route::group(['prefix' => 'admin'], function () {
    // Home
    Route::get('/', 'Admin\AdminHomeController@index')->name('admin.home');
    
    // Users
    Route::get('/users', 'Admin\AdminUserController@index')->name('admin.users');
    Route::get('/users/a', 'Admin\AdminUserController@edit')->name('admin.users.edit');
    Route::post('/users/{user}', 'Admin\AdminUserController@update')->name('admin.users.update');

    // Roles
    Route::get('/roles', 'Admin\AdminRolesController@index')->name('admin.roles');
    Route::post('/roles/create', 'Admin\AdminRolesController@store')->name('admin.roles.create');
    Route::patch('/roles/{role}', 'Admin\AdminRolesController@update')->name('admin.roles.update');
    Route::delete('/roles/{role}', 'Admin\AdminRolesController@destroy')->name('admin.roles.destroy');

    // Settings
    Route::get('/settings/{category}', 'Admin\AdminSettingsController@index')->name('admin.settings');
    Route::patch('/settings/{category}', 'Admin\AdminSettingsController@save')->name('admin.settings.save');

    // Applications
    Route::get('/applications', 'Admin\AdminApplicationController@index')->name('admin.apply');
    Route::get('/applications/{applicationId}', 'Admin\AdminApplicationController@show')->name('admin.apply.view');

    Route::patch('/applications/{applicationId}', 'Admin\AdminApplicationController@assign')->name('admin.apply.assign');
    Route::patch('/applications/{applicationId}/complete', 'Admin\AdminApplicationController@complete')->name('admin.apply.complete');

    // Servers
    Route::get('/servers', 'Admin\AdminServerController@index')->name('admin.servers');
    Route::post('/servers', 'Admin\AdminServerController@store')->name('admin.servers.store');
    Route::delete('/servers/{server}', 'Admin\AdminServerController@destroy')->name('admin.servers.destroy');

    // Forums
    Route::get('/forums', 'Admin\Forums\IndexController@index')->name('admin.forums.index');

    Route::get('/categories', 'Admin\Forums\CategoryController@index')->name('admin.categories');
    Route::post('/categories', 'Admin\Forums\CategoryController@store')->name('admin.categories.store');
    Route::patch('/categories/{category}', 'Admin\Forums\CategoryController@update')->name('admin.categories.update');
    Route::delete('/categories/{category}', 'Admin\Forums\CategoryController@destroy')->name('admin.categories.destroy');

    Route::get('/boards', 'Admin\Forums\BoardController@index')->name('admin.forums.boards');
    Route::post('/boards', 'Admin\Forums\BoardController@store')->name('admin.boards.store');
    Route::patch('/boards/{board}', 'Admin\Forums\BoardController@update')->name('admin.boards.update');
    Route::delete('/boards/{board}', 'Admin\Forums\BoardController@destroy')->name('admin.boards.destroy');

    Route::patch('/boards', 'Admin\Forums\BoardController@sort')->name('admin.boards.sort');
});


Route::get('/install', 'InstallController@index')->name('install.welcome')
    ->withoutMiddleware(AuthenticateSession::class);

Route::post('/install', 'InstallController@install')->name('install.complete')
    ->withoutMiddleware(AuthenticateSession::class);