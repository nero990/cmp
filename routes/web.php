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


// Church Engagement Module
Route::prefix('church-engagements')->namespace('ChurchEngagement')->name('church-engagements.')->group(function () {
    // Member submodule
    Route::prefix('{church_engagement}/members')->name('members.')->group(function () {
        Route::get('', 'MemberController@index')->name('index');
        Route::post('', 'MemberController@store')->name('store');
    });
});
Route::resource('church-engagements', 'ChurchEngagementController')->except(['edit', 'create']);


// Family Module
Route::prefix('families')->namespace('Family')->name('families.members.')->group(function () {
    Route::prefix('{family}')->group(function () {
        Route::get('members/create', 'MemberController@create')->name('create');
        Route::post('members', 'MemberController@store')->name('store');
    });

    Route::prefix('members')->group(function () {

        Route::get('auto-complete', 'MemberController@autoComplete')->name('autoComplete');

        Route::prefix('{member}')->group(function () {
            Route::get('', 'MemberController@edit')->name('show');
            Route::get('edit', 'MemberController@edit')->name('edit');
            Route::put('', 'MemberController@update')->name('update');
            Route::delete('', 'MemberController@destroy')->name('destroy');
        });
    });
});
Route::resource('families', 'FamilyController');

Route::resource('sacrament-details', 'SacramentDetailController');

// System Tools
Route::group(['prefix' => 'tool-kits', 'as' => 'toolKit'], function () {
    Route::get( 'cmd', ['as' => 'index', 'uses' => 'ToolKitController@index' ] );
    Route::post( 'cmd', ['as' => 'exec', 'uses' => 'ToolKitController@exec' ] );
});