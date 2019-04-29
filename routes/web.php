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

use App\TariffProviderTariffMatch;

Route::get("test", function () {
    $allTptp = TariffProviderTariffMatch::groupBy("user_id")
        ->join("users", "users.id", "tariff_provider_tariff_matches.user_id")
        ->selectRaw("CONCAT(username, ' ', last_logged_in) as name, SUM(CASE WHEN active_status='ACTIVE' THEN 1 ELSE 0 END) AS valid, " .
        "SUM(CASE WHEN active_status='PENDING' THEN 1 ELSE 0 END) AS pending, " .
        "SUM(CASE WHEN active_status='DELETED' THEN 1 ELSE 0 END) AS invalid, " .
            "COUNT(active_status) AS total")->get();

    $cash = 40;
//    $cash = floatval(GlobalVariable::getById(GlobalVariable::STANDARDIZATION_UNIT_PRICE)->value);
    $allTptp->each(function ($tptp) use ($cash){
        $tptp->cash = number_format($tptp->valid * $cash, 2);
    });




    return (["users" => $allTptp->toArray()]);
//    return ($allTptp);
    foreach ($allTptp->groupBy('user_id') as $each) {
        $one = [];
        $one['name'] = $each[0]->user->username;
        $one['valid'] = 0;
        $one['pending'] = 0;
        $one['invalid'] = 0;
        $one['total'] = 0;
        $one['cash'] = 0;
        foreach ($each as $single) {
            switch ($single->active_status) {
                case "ACTIVE": // 1
                    $one['valid']++;
//                    $one['cash'] += floatval(GlobalVariable::getById(GlobalVariable::STANDARDIZATION_UNIT_PRICE)->value);
                    break;
                case "PENDING": // 2
                    $one['pending']++;
                    break;
                case "DELETED": // 3
                    $one['invalid']++;
                    break;
            }
            $one['total']++;
        }
        $one['cash'] = number_format($one['cash'],2);
        array_push($data['users'], $one);
    }
    return $data;
});


Route::redirect('/', 'home');

Route::group([], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login')->middleware('guest');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // BCC Zone Module
    Route::prefix('bcc-zones')->name('bcc-zones.')->group(function () {
        Route::post('bulk_upload', 'BccZoneController@bulkUpload')->name('bulk-upload');
        Route::get('{bcc_zone}/audits', 'BccZoneController@audits')->name('audits');
        Route::get('export/{type}', 'BccZoneController@exportAll')->name('exportAll');
    });
    Route::resource('bcc-zones', 'BccZoneController');

    // Church Engagement Module
    Route::prefix('church-engagements')->name('church-engagements.')->group(function () {

        Route::prefix('{church_engagement}')->group(function () {
            Route::get('audits', 'ChurchEngagementController@audits')->name('audits');

            // Namespace: ChurchEngagement
            Route::namespace('ChurchEngagement')->group(function() {
                // Member submodule
                Route::prefix('members')->name('members.')->group(function () {
                    Route::get('', 'MemberController@index')->name('index');
                    Route::post('', 'MemberController@store')->name('store');
                });
            });
        });
    });
    Route::resource('church-engagements', 'ChurchEngagementController')->except(['edit', 'create']);

    // Uploaded File Module
    Route::prefix('uploaded-files')->name('uploaded-files.')->group(function () {
        Route::get('', 'UploadedFileController@index')->name('index');
        Route::get('{uploaded_file}', 'UploadedFileController@show')->name('show');
        Route::get('{uploaded_file}/report', 'UploadedFileController@report')->name('report');
    });

    // Family Module
    Route::prefix('families')->name('families.')->group(function () {

        Route::get('export/{type}', 'FamilyController@exportAll')->name('exportAll');
        Route::post('bulk-upload', 'FamilyController@bulkUpload')->name('bulk-upload');
        Route::get('{family}/audits', 'FamilyController@audits')->name('audits');

        // namespace: Family
        Route::namespace('Family')->group(function () {
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
                        Route::get('audits', 'MemberController@audits')->name('audits');
                    });
                });
            });
        });

    });
    Route::resource('families', 'FamilyController');

    // Report Module
    Route::prefix('reports')->namespace('Report')->name('reports.')->group(function() {
        // Members Submodule
        Route::prefix('members')->name('members.')->group(function () {
           Route::get('', 'MemberController@index')->name('index');
            Route::get('export/{type}', 'MemberController@export')->name('export');
        });

        // Audit report
        Route::prefix('audits')->name('audits.')->group(function () {
           Route::get('', 'AuditController@index')->name('index');
        });
    });

    // Sacrament Question Module
    Route::get('sacrament-questions/{sacrament_question}/audits', 'SacramentQuestionController@audits')->name('sacrament-questions.audits');
    Route::resource('sacrament-questions', 'SacramentQuestionController')->except(['show']);

    // User Module
    Route::resource('users', 'UserController')->except(['create', 'show']);

    // Setting Module
    Route::resource('settings', 'SettingController')->only(['index', 'edit', 'update']);

    // System Tools
    Route::group(['prefix' => 'tool-kits', 'as' => 'toolKit'], function () {
        Route::get( 'cmd', ['as' => 'index', 'uses' => 'ToolKitController@index' ] );
        Route::post( 'cmd', ['as' => 'exec', 'uses' => 'ToolKitController@exec' ] );
    });

});

