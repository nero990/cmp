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


Route::get('/home', 'HomeController@index')->name('home');


//Route::namespace('Auth')->group(function() {
//    // Authentication Routes...
//    Route::get('login', 'LoginController@showLoginForm')->name('login');
//    Route::post('login', 'LoginController@login');
//    Route::post('logout', 'LoginController@logout')->name('logout');
//
//    // Password Reset Routes...
//    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
//    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
//    Route::post('password/reset', 'ResetPasswordController@reset');
//});


//Route::view('/home', 'admin.index');

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

Route::resource('sacrament-questions', 'SacramentQuestionController');

// System Tools
Route::group(['prefix' => 'tool-kits', 'as' => 'toolKit'], function () {
    Route::get( 'cmd', ['as' => 'index', 'uses' => 'ToolKitController@index' ] );
    Route::post( 'cmd', ['as' => 'exec', 'uses' => 'ToolKitController@exec' ] );
});
