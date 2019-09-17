<?php

use App\Http\Controllers\Backend\DashboardController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('categories', 'AdminCategoryController@index')->name('categories');
//Route::get('periods', 'PeriodsController@generatePaymentPeriods')->name('periods');
Route::get('coupons', 'AdminCouponController@index')->name('coupons');
Route::get('courses', 'AdminCourseController@index')->name('courses.all');
Route::get('courses/{uuid}', 'AdminCourseController@details')->name('courses.details');
Route::get('courses/featured', 'AdminCourseController@featured')->name('courses.featured');


Route::get('transactions', 'AdminTransactionController@index')->name('finances.transactions');
Route::get('payouts/periods', 'AdminPayoutController@index')->name('finances.payout.periods');
Route::get('payouts/period/{uuid}', 'AdminPayoutController@payoutDetails')->name('finances.payout.periods.details');
Route::get('refunds', 'AdminRefundController@index')->name('finances.refunds');


// Settings
Route::get('settings', 'AdminSettingsController@index')->name('settings');


/******** LOCALES *************** */
//Route::get('locales', 'AdminLocaleManager@index')->name('locales');

Route::get('locales', [
    'uses' => 'AdminLocaleManager@getIndex',
    'as' => 'locales.index'
]);

Route::get('locales/view/{group?}', [
    'uses' => 'AdminLocaleManager@getView',
    'as' => 'locales.view'
]);

Route::get('locales/view/{group?}', [
    'uses' => 'AdminLocaleManager@getView',
    'as' => 'locales.view'
]);

Route::post('locales/edit/{group?}', [
    'uses' => 'AdminLocaleManager@postEdit',
    'as' => 'admin.translations.edit'
]);

Route::post('locales/import', [
    'uses' => 'AdminLocaleManager@postImport',
    'as' => 'admin.translations.import'
]);

Route::post('locales/find', [
    'uses' => 'AdminLocaleManager@postFind',
    'as' => 'admin.translations.find'
]);

Route::post('locales/publish/{group}', [
    'uses' => 'AdminLocaleManager@postPublish',
    'as' => 'admin.translations.publish'
]);

Route::post('locales/add/{group}', [
    'uses' => 'AdminLocaleManager@postAdd',
    'as' => 'admin.translations.add'
]);

Route::post('locales/delete/{group}/{key}', [
    'uses' => 'AdminLocaleManager@postDelete',
    'as' => 'admin.translations.delete'
]);
