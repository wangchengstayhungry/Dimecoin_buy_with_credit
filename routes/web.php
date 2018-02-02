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

Route::get('/', 'LandingController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/profile', 'HomeController@profile_save')->name('profile');
Route::get('/profile', 'HomeController@profile_view')->name('profile');
Route::get('/paymentmethod', 'HomeController@paymentmethod')->name('paymentmethod');
Route::post('/paymentmethod/proofupload', 'HomeController@proofupload')->name('proofupload');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/walletinfo', 'HomeController@walletinfo')->name('walletinfo');
Route::post('/walletinfo', 'HomeController@walletinfo_completed')->name('walletinfo_completed');
Route::get('/walletinfobycoin', 'HomeController@walletinfobycoin')->name('walletinfobycoin');
Route::post('/walletinfosave', 'HomeController@walletinfoSave');
Route::get('/transactions', 'HomeController@transactions')->name('transactions');

Route::get('/realtime_currency', 'BithumbCurrencyController@getRealtimeCurrency');
Route::post('/realtime_currency_dbset', 'BithumbCurrencyController@setPriceDB');
Route::get('/realtime_currency_db', 'BithumbCurrencyController@getPriceDB');
//order
Route::post('/order', 'OrderController@makeorder');
Route::get('/order/myOrders', 'OrderController@myOrders')->name('order.myorders');

Route::get('/getwalletaddress', 'HomeController@getwalletaddress');

Route::post('/localization', 'LocalizationController@setLocalization');

Route::group(['prefix' => 'backend'], function () {
	Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Admin\Auth\LoginController@login');
	Route::get('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

	Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
	
	Route::get('/orders/all', 'Admin\OrdersController@index')->name('admin.orders.all');
	Route::get('/orders/completed', 'Admin\OrdersController@completedOrdersView')->name('admin.orders.completed');
	Route::get('/orders/completedorders', 'Admin\OrdersController@completedOrders')->name('admin.completedorders');
	Route::get('/orders/new', 'Admin\OrdersController@newOrdersView')->name('admin.orders.new');
	Route::get('/orders/neworders', 'Admin\OrdersController@newOrders')->name('admin.neworders');
	Route::get('/orders/orders/state/{id}', 'Admin\OrdersController@stateView');
	Route::post('/orders/orders/state/save', 'Admin\OrdersController@stateSave');
	Route::get('/orders/anyorders', 'Admin\OrdersController@anyOrders')->name('admin.anyorders');

	Route::get('/reports', 'Admin\ReportsController@index')->name('admin.reports');
	Route::post('/reports', 'Admin\ReportsController@search')->name('admin.reports.search');
	Route::get('/users', 'Admin\UsersController@index')->name('admin.users');
	Route::get('/users/anyusers', 'Admin\UsersController@anyUsers')->name('admin.anyusers');
	Route::get('/users/edit/{id}', 'Admin\UsersController@edit');
	Route::post('/users/edit/{id}', 'Admin\UsersController@edit_save');
	Route::get('/users/remove/{id}', 'Admin\UsersController@remove');

	Route::get('/settings/social', 'Admin\SettingsController@social')->name('admin.settings.social');	
	Route::post('/settings/social', 'Admin\SettingsController@socialsave')->name('admin.settings.social');
	Route::get('/settings/payment', 'Admin\SettingsController@payment')->name('admin.settings.payment');	
	Route::post('/settings/payment', 'Admin\SettingsController@paymentsave')->name('admin.settings.payment');
	Route::get('/settings/payment', 'Admin\SettingsController@payment')->name('admin.settings.payment');	
	Route::post('/settings/payment', 'Admin\SettingsController@paymentsave')->name('admin.settings.payment');
	Route::get('/settings/faq', 'Admin\SettingsController@faq')->name('admin.settings.faq');	
	Route::post('/settings/faq', 'Admin\SettingsController@faqsave')->name('admin.settings.faq');
	Route::get('/settings/text', 'Admin\SettingsController@text')->name('admin.settings.text');	
	Route::post('/settings/text', 'Admin\SettingsController@textsave')->name('admin.settings.text');

	Route::get('/setting','Admin\UsersController@adminSetting')->name('admin.setting');
	Route::post('/setting','Admin\UsersController@adminSettingSave')->name('admin.setting.save');
});



Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

