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

Route::get('/', 'LandingController@index');  

Auth::routes();

Route::get('/register-admin', 'AdminController@register');
Route::post('/create_admin_user', 'AdminController@create_admin_user')->name('create_admin_user');

Route::group(['middleware' => ['is_admin']], function() {
	Route::get('/admin', 'AdminController@index')    
   		->name('admin');

	Route::get('/admin/change_password', 'AdminController@change_password');
	Route::post('/admin/update_password', 'AdminController@update_password');

	Route::get('/admin/clients', 'AdminClientController@index');
	Route::get('/admin/client/{id}', 'AdminClientController@edit');
	Route::put('/admin/client/update/{id}', 'AdminClientController@update')->name('admin.client.update');
	Route::get('/admin/client/disconnection_reasons/{id}', 'AdminClientController@show_disconnection_reasons');
	Route::get('/admin/client/disconnection_reason/create/{id}', 'AdminClientController@create_disconnection_reason');
	Route::post('/admin/client/disconnection_reason/store', 'AdminClientController@store_disconnection_reason');
	Route::delete('/admin/client/delete_disconnection_status/{id}', 'AdminClientController@delete_disconnection_reason');

	Route::get('/admin/subscriptions', 'AdminSubscriptionController@index');
	
	Route::get('/admin/billings', 'AdminBillingController@index');
	
	Route::get('/admin/payments', 'AdminPaymentController@index');
	
	Route::get('/admin/domains', 'AdminDomainController@index');
	
	Route::get('/admin/settings', 'AdminSettingController@index');
	Route::get('/admin/setting/{id}', 'AdminSettingController@edit');
	Route::put('/admin/setting/update/{id}', 'AdminSettingController@update')->name('admin.setting.update');
});

Route::group(['middleware' => ['is_patient']], function() {
	Route::get('/patient_view', 'PatientController@patient_view') 
	    ->name('patient_view');

    Route::post('/patient_view/print_prescription', 'PatientController@print_prescription');
});

Route::group(['middleware' => ['is_default']], function() {
	Route::get('/home', 'HomeController@index')
		->name('home');	

	Route::get('/business_information', 'AccountController@business_information');
	Route::post('/update_business_information', 'AccountController@update_business_information');

	Route::get('/success', 'AccountController@success');
	Route::get('/failed', 'AccountController@failed');

	Route::get('/change_password', 'AccountController@change_password');
	Route::post('/update_password', 'AccountController@update_password');

	Route::get('patients_list', 'CalendarController@patients_list');
	
	Route::resource('user', 'UserController');
	Route::resource('patient', 'PatientController');
	Route::resource('clinic', 'ClinicController');
	Route::resource('doctor', 'DoctorController');
	Route::resource('calendar', 'CalendarController');
	Route::resource('service', 'ServiceController');
	Route::resource('invoice', 'InvoiceController');
	Route::resource('payment', 'PaymentController');

	Route::post('patient/search', 'PatientController@search');

	Route::post('/patient/create_detail', 'PatientController@create_patient_detail');
	Route::post('/patient/update_detail/{id}', 'PatientController@update_patient_detail');
	Route::post('/patient/upload_detail', 'PatientController@upload_detail');
	Route::delete('/patient/delete_detail/{id}', 'PatientController@delete_patient_detail');
	Route::post('/patient/bulk_delete_detail', 'PatientController@bulk_delete_patient_detail');

	Route::get('/patient/download_medical_record/{patient_id}', 'PatientController@download_medical_record');
	
	Route::post('/patient/archive_detail/{id}', 'PatientController@archive_patient_detail');
	Route::post('/patient/unarchive_detail/{id}', 'PatientController@unarchive_patient_detail');

	Route::post('/patient/store_prescription', 'PatientController@store_prescription');
	Route::delete('/patient/delete_prescription/{id}', 'PatientController@delete_prescription');
	Route::post('/patient/print_prescription', 'PatientController@print_prescription');

	Route::post('/invoice/create_billing_charge', 'InvoiceController@create_billing_charge');
	Route::delete('/invoice/delete_charge/{id}', 'InvoiceController@delete_patient_charge');
	Route::post('invoice/search', 'InvoiceController@search');

	Route::post('/payment/create_billing_payment', 'PaymentController@create_billing_payment');
	Route::delete('/payment/delete_payment/{id}', 'PaymentController@delete_patient_payment');
	Route::post('payment/search', 'PaymentController@search');

	Route::post('/calendar/scheduled_patients', 'CalendarController@scheduled_patients');
	Route::post('/calendar/get_all_appointments', 'CalendarController@get_all_appointments');

	Route::post('/user/update_privilege/{id}', 'UserController@update_privilege');

	Route::get('/dental_chart', 'DentalChartController@index');
	Route::post('/dental_chart', 'DentalChartController@store');
	Route::delete('/dental_chart/{id}', 'DentalChartController@destroy');
	Route::post('/dental_chart/get_attributes', 'DentalChartController@get_attributes');
	Route::post('/dental_chart/update_attribute', 'DentalChartController@update_attribute');
	Route::post('/dental_chart/get_patient_attributes', 'DentalChartController@get_patient_attributes');

	Route::delete('/attachment/delete/{id}', 'AttachmentController@delete');

	Route::get('/subscription', 'SubscriptionController@index');
	Route::get('/view_estatements', 'SubscriptionController@view_estatements');
	Route::get('/balance_and_usage', 'SubscriptionController@balance_and_usage');
	Route::get('/pay_bills', 'SubscriptionController@pay_bills');
	Route::post('/subscription/subscribe', 'SubscriptionController@subscribe');
});

