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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', ['as' => 'activity.dashboard', 'uses' => 'ActivityReportController@dashboard'])->middleware('auth');

Route::prefix('activity')->group(function () {
    Route::get('/create', ['as' => 'activity.create-form', 'uses' => 'ActivityCreateController@createForm'])->middleware('auth');

    Route::post('/create', ['as' => 'activity.create', 'uses' => 'ActivityCreateController@create']);

    Route::post('/report', ['as' => 'activity.report', 'uses' => 'ActivityReportController@report']);
});

Route::prefix('report')->group(function() {
    Route::get('/{url}', ['as' => 'report.access-url', 'uses' => 'ReportReviewThroughAccessUrlController@display']);

    Route::get('/print/daily', ['as' => 'reports.print', 'uses' => 'ReportPrintController@display']);

    Route::post('/print/daily', ['as' => 'reports.print.daily', 'uses' => 'ReportPrintController@getDailyActivityTime']);

    Route::post('/email-url', ['as' => 'report.email.url', 'uses' => 'EmailAccessUrlToUserController@emailUrlToUser']);
});

