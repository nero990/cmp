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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/home', 'admin.index');

Route::resource('bcc-zones', 'BccZoneController');

Route::get('church-engagements/{church_engagement}/members', 'ChurchEngagementController@members')->name('church-engagements.members');
Route::resource('church-engagements', 'ChurchEngagementController')->except(['edit', 'create']);

Route::resource('families', 'FamilyController');

Route::resource('sacrament-details', 'SacramentDetailController');