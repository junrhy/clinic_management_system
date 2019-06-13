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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('patients_list', 'ScheduleController@patients_list');

Route::resource('users/roles', 'RoleController');
Route::resource('users/role_members', 'RoleUserController');
Route::resource('user', 'UserController');
Route::resource('patient', 'PatientController');
Route::resource('clinic', 'ClinicController');
Route::resource('doctor', 'DoctorController');
Route::resource('calendar', 'CalendarController');
