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

//    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/home', 'DashboardController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/department/get-price', 'DepartmentController@getPrice')->name('get.price');
    Route::match(['get','post'], '/report', 'ReportController@index')->name('report');

    Route::resource('employee', 'EmployeeController');
    Route::resource('department', 'DepartmentController');
    Route::resource('work', 'WorkController');

});

