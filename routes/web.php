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
    return redirect()->route('home');
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    //Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/home', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::post('/employee/get-info', 'EmployeeController@getInfo')->name('get.info');
    Route::match(['get','post'], '/report', 'ReportController@index')->name('report');
    Route::match(['get','post'], '/report/generate', 'ReportController@generate')->name('report.generate');
    Route::match(['get','post'], '/work/remove', 'WorkController@remove')->name('work.remove');

    Route::resource('employee', 'EmployeeController');
    Route::resource('department', 'DepartmentController');
    Route::resource('work', 'WorkController');
    Route::resource('zone', 'ZoneController');


    Route::get('employeewise','ReportController@employeewise');

});

