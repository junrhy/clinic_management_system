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
    return view('landing.register_with_video');
});

Auth::routes();

Route::group(['middleware' => ['is_admin']], function() {
	Route::get('/admin', 'AdminController@admin')    
   		->name('admin');
});

Route::group(['middleware' => ['is_patient']], function() {
	Route::get('/patient_view', 'PatientController@patient_view') 
	    ->name('patient_view');
});

Route::group(['middleware' => ['is_default']], function() {
	Route::get('/home', 'HomeController@index')
		->name('home');	

	Route::get('/business_information', 'AccountController@business_information');
	Route::post('/update_business_information', 'AccountController@update_business_information');

	Route::get('/success', 'AccountController@success');
	Route::get('/cancel', 'AccountController@cancel');

	Route::get('/change_password', 'AccountController@change_password');
	Route::post('/update_password', 'AccountController@update_password');

	Route::get('patients_list', 'CalendarController@patients_list');

	Route::resource('user', 'UserController');
	Route::resource('patient', 'PatientController');
	Route::resource('clinic', 'ClinicController');
	Route::resource('doctor', 'DoctorController');
	Route::resource('calendar', 'CalendarController');
	Route::resource('service', 'ServiceController');

	Route::post('/patient/create_detail', 'PatientController@create_patient_detail');
	Route::post('/patient/update_detail/{id}', 'PatientController@update_patient_detail');
	Route::delete('/patient/delete_detail/{id}', 'PatientController@delete_patient_detail');
	Route::post('/patient/bulk_delete_detail', 'PatientController@bulk_delete_patient_detail');

	Route::post('/patient/archive_detail/{id}', 'PatientController@archive_patient_detail');
	Route::post('/patient/unarchive_detail/{id}', 'PatientController@unarchive_patient_detail');

	Route::post('/patient/create_billing_charge', 'PatientController@create_billing_charge');
	Route::delete('/patient/delete_charge/{id}', 'PatientController@delete_patient_charge');

	Route::post('/patient/create_billing_payment', 'PatientController@create_billing_payment');
	Route::delete('/patient/delete_payment/{id}', 'PatientController@delete_patient_payment');

	Route::post('/calendar/scheduled_patients', 'CalendarController@scheduled_patients');

	Route::get('/dental_chart', 'DentalChartController@index');

	// Webhooks
	Route::any('/paypal_subscription_activated', 'WebhookController@paypal_subscription_activated');
});

