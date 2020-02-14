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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::resource('hives', 'HiveController');
    Route::resource('apiaries', 'ApiaryController');
    Route::resource('types', 'HiveTypeController');
    Route::resource('queens', 'QueenController');
    Route::resource('harvests', 'HarvestController');
    Route::resource('inspections', 'InspectionController');
});

