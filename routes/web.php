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
Route::get('/companies/datatable','CompanyController@getIndexDataTable')->name('companies.dataTable');
Route::resource('/companies', 'CompanyController');
Route::resource('/employees', 'EmployeeController',['only'=>['create','edit','store','update','destroy']]);
Route::get('/companies/{company}/employees','EmployeeController@index')->name('employees.index');
// Route::view('/test', 'test.index');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/employee/export/{company}', 'EmployeeController@export')->name('download');
