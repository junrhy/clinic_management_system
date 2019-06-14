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
Route::get('patients_list', 'CalendarController@patients_list');

Route::resource('users/roles', 'RoleController');
Route::resource('users/role_members', 'RoleUserController');
Route::resource('user', 'UserController');
Route::resource('patient', 'PatientController');
Route::resource('clinic', 'ClinicController');
Route::resource('doctor', 'DoctorController');
Route::resource('calendar', 'CalendarController');

Route::post('/patient/create_detail', 'PatientController@create_patient_detail');
Route::delete('/patient/delete_detail/{id}', 'PatientController@delete_patient_detail');

Route::post('/patient/create_billing_charge', 'PatientController@create_billing_charge');
Route::delete('/patient/delete_charge/{id}', 'PatientController@delete_patient_charge');

Route::post('/patient/create_billing_payment', 'PatientController@create_billing_payment');
Route::delete('/patient/delete_payment/{id}', 'PatientController@delete_patient_payment');