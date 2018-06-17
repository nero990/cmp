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

Route::redirect('/', 'home');

Route::group([], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login')->middleware('guest');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // BCC Zone Module
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
    Route::prefix('families')->namespace('Family')->name('families.')->group(function () {

        // Family members
        Route::name('members.')->group(function () {
            Route::prefix('{family}')->group(function () {
                Route::get('members/create', 'MemberController@create')->name('create');
                Route::post('members', 'MemberController@store')->name('store');
            });

            Route::prefix('members')->group(function () {
                Route::get('auto-complete', 'MemberController@autoComplete')->name('autoComplete');

                Route::prefix('{member}')->group(function () {
                    Route::get('', 'MemberController@show')->name('show');
                    Route::get('edit', 'MemberController@edit')->name('edit');
                    Route::put('', 'MemberController@update')->name('update');
                    Route::delete('', 'MemberController@destroy')->name('destroy');
                });
            });
        });

    });
    Route::post('families/batch-upload', 'FamilyController@batchUpload')->name('families.batch-upload');
    Route::resource('families', 'FamilyController');

    // Report Module
    Route::prefix('reports')->namespace('Report')->name('reports.')->group(function() {
        // Members Submodule
        Route::prefix('members')->name('members.')->group(function () {
           Route::get('', 'MemberController@index')->name('index');
        });
    });

    // Sacrament Question Module
    Route::resource('sacrament-questions', 'SacramentQuestionController');

    // User Module
    Route::resource('users', 'UserController')->except(['create', 'show']);


    // System Tools
    Route::group(['prefix' => 'tool-kits', 'as' => 'toolKit'], function () {
        Route::get( 'cmd', ['as' => 'index', 'uses' => 'ToolKitController@index' ] );
        Route::post( 'cmd', ['as' => 'exec', 'uses' => 'ToolKitController@exec' ] );
    });

});

