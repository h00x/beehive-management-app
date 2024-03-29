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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');
    Route::get('/profile/remove-image', 'ProfileController@removeImage')->name('profile.remove-image');
    Route::get('/change-password', 'ChangePasswordController@index')->name('changePassword.index');
    Route::patch('/change-password', 'ChangePasswordController@update')->name('changePassword.update');

    Route::resource('hives', 'HiveController');
    Route::resource('apiaries', 'ApiaryController');
    Route::resource('types', 'HiveTypeController');
    Route::resource('queens', 'QueenController');
    Route::resource('harvests', 'HarvestController');
    Route::resource('inspections', 'InspectionController');
});

