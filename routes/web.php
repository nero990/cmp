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

Route::prefix('families')->name('families.members.')->group(function () {
    Route::get('{family}/members', 'MemberController@create')->name('create');
    Route::post('{family}/members', 'MemberController@store')->name('store');
    Route::get('members/{member}', 'MemberController@edit')->name('edit');
    Route::put('members/{member}', 'MemberController@update')->name('update');
    Route::delete('members/{member}', 'MemberController@destroy')->name('destroy');
});
Route::resource('families', 'FamilyController');

Route::resource('sacrament-details', 'SacramentDetailController');