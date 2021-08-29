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
Route::get('/profile/{client_slug}', 'LandingController@client_page'); 
Route::post('/landing/contact_us', 'LandingController@send_contact_us_message'); 

Auth::routes();

Route::get('/register-admin', 'AdminController@register');
Route::post('/create_admin_user', 'AdminController@create_admin_user')->name('create_admin_user');

Route::get('/patient-registration-form', 'PatientController@register_as_patient');
Route::post('/create_patient_user', 'PatientController@create_patient_user')->name('create_patient_user');

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
	Route::get('/admin/inactive_clients', 'AdminClientController@inactive_clients');
	Route::post('/admin/delete_client', 'AdminClientController@delete_client');

	Route::get('/admin/subscriptions', 'AdminSubscriptionController@index');
	Route::get('/admin/subscription/renew/{id}', 'AdminSubscriptionController@renew');
	
	Route::get('/admin/billings', 'AdminBillingController@index');
	Route::get('/admin/billing/view_estatements/{id}', 'AdminBillingController@view_estatements');
	Route::get('/admin/billing/create/{id}', 'AdminBillingController@create_estatement');
	Route::post('/admin/billing/store', 'AdminBillingController@store_estatement');
	Route::get('/admin/billing/edit/{id}', 'AdminBillingController@edit_estatement');
	Route::put('/admin/billing/update/{id}', 'AdminBillingController@update_estatement')->name('admin.billing.update');
	Route::delete('/admin/billing/delete/{id}', 'AdminBillingController@delete_estatement');
	Route::put('/admin/billing/publish/{id}', 'AdminBillingController@publish_estatement');
	Route::get('/admin/billing/view/{id}', 'AdminBillingController@pdf_estatement');

	Route::get('/admin/payments', 'AdminPaymentController@index');
	Route::get('/admin/payments/view_payments/{client_id}', 'AdminPaymentController@view_payments');
	Route::get('/admin/payment/create/{client_id}', 'AdminPaymentController@create_payment');
	Route::post('/admin/payment/store', 'AdminPaymentController@store_payment');
	Route::delete('/admin/payment/delete/{id}', 'AdminPaymentController@delete_payment');
	
	Route::get('/admin/domains', 'AdminDomainController@index');
	Route::get('/admin/domain/create', 'AdminDomainController@create');
	Route::post('/admin/domain/store', 'AdminDomainController@store');
	Route::delete('/admin/domain/delete/{id}', 'AdminDomainController@delete');
	
	Route::get('/admin/settings', 'AdminSettingController@index');
	Route::get('/admin/setting/create', 'AdminSettingController@create');
	Route::post('/admin/setting/store', 'AdminSettingController@store');
	Route::get('/admin/setting/{id}', 'AdminSettingController@edit');
	Route::put('/admin/setting/update/{id}', 'AdminSettingController@update')->name('admin.setting.update');
});

Route::group(['middleware' => ['is_patient']], function() {
	Route::get('/patient_view', 'PatientController@patient_view') 
	    ->name('patient_view');

    Route::post('/patient_view/print_prescription', 'PatientController@print_prescription');

    Route::get('/patient_view/change_password', 'PatientViewController@change_password');
    Route::post('/patient_view/update_password', 'PatientViewController@update_password');

    Route::get('/patient_view/request_appointment', 'PatientViewController@request_appointment');
    Route::post('/patient_view/submit_appointment_request', 'PatientViewController@submit_appointment_request');
});

Route::group(['middleware' => ['is_default']], function() {
	Route::get('/home', 'HomeController@index')
		->name('home');	

	Route::get('/business_information', 'AccountController@business_information');
	Route::post('/update_business_information', 'AccountController@update_business_information');
	Route::get('/delete_company_logo/{id}', 'AccountController@delete_company_logo');

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
	Route::resource('inventory', 'InventoryController');
	Route::resource('invoice', 'InvoiceController');
	Route::resource('payment', 'PaymentController');

	Route::post('patient/search', 'PatientController@search');
	Route::get('patient_registration_requests', 'PatientController@patient_registration_requests');
	Route::post('/patient_registration/request/approved', 'PatientController@patient_registration_request_approved');
	Route::delete('/patient_registration/request/denied/{id}', 'PatientController@patient_registration_request_denied');

	Route::get('/delete_patient_profile_pic/{id}', 'PatientController@delete_patient_profile_pic');
		
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
	Route::get('/patient/create_account/{id}', 'PatientController@create_patient_user_account');
	Route::post('/patient/save_patient_user_account', 'PatientController@save_patient_user_account');
	Route::post('/remove_patient_user_account', 'PatientController@remove_patient_user_account');

	Route::post('/invoice/create_billing_charge', 'InvoiceController@create_billing_charge');
	Route::delete('/invoice/delete_charge/{id}', 'InvoiceController@delete_patient_charge');
	Route::post('invoice/search', 'InvoiceController@search');

	Route::post('/payment/create_billing_payment', 'PaymentController@create_billing_payment');
	Route::delete('/payment/delete_payment/{id}', 'PaymentController@delete_patient_payment');
	Route::post('payment/search', 'PaymentController@search');

	Route::post('/calendar/scheduled_patients', 'CalendarController@scheduled_patients');
	Route::post('/calendar/get_all_appointments', 'CalendarController@get_all_appointments');
	Route::post('/calendar/get_appointment_status_count', 'CalendarController@get_appointment_status_count');
	Route::get('/appointment/requests', 'CalendarController@show_appointment_requests');
	Route::post('/appointment/request/approved', 'CalendarController@appointment_request_approved');
	Route::delete('/appointment/request/denied/{id}', 'CalendarController@appointment_request_denied');

	Route::post('/user/update_privilege/{id}', 'UserController@update_privilege');

	Route::get('/dental_chart', 'DentalChartController@index');
	Route::post('/dental_chart', 'DentalChartController@store');
	Route::delete('/dental_chart/{id}', 'DentalChartController@destroy');
	Route::post('/dental_chart/get_attributes', 'DentalChartController@get_attributes');
	Route::post('/dental_chart/update_attribute', 'DentalChartController@update_attribute');
	Route::post('/dental_chart/get_patient_attributes', 'DentalChartController@get_patient_attributes');
	Route::post('/dental_notes/update_note', 'DentalChartController@update_note');

	Route::delete('/attachment/delete/{id}', 'AttachmentController@delete');

	Route::get('/subscription', 'SubscriptionController@index');
	Route::get('/payment_method', 'SubscriptionController@payment_method');
	Route::post('/payment_method/save_card', 'SubscriptionController@save_card');
	Route::post('/payment_method/remove_card', 'SubscriptionController@remove_card');
	Route::post('/payment_method/make_primary', 'SubscriptionController@make_primary');
	Route::get('/view_estatements', 'SubscriptionController@view_estatements');
	Route::get('/view_billing_statement/{id}', 'SubscriptionController@view_billing_statement');
	Route::get('/balance_and_usage', 'SubscriptionController@balance_and_usage');
	Route::get('/pay_bills', 'SubscriptionController@pay_bills');
	Route::post('/subscription/subscribe', 'SubscriptionController@subscribe');
	Route::post('/subscription/cancel_auto_renew', 'SubscriptionController@cancel_auto_renew');
	Route::post('/subscription/enable_auto_renew', 'SubscriptionController@enable_auto_renew');


	Route::get('/inventory/show/{name}', 'InventoryController@show');
	Route::get('/inventory/add_by_sku/{name}', 'InventoryController@add_by_sku');
	Route::get('/inventory/inventory_out/{name}', 'InventoryController@inventory_out');
	Route::post('inventory_in/store', 'InventoryController@inventory_in_store');
	Route::post('inventory_out/update', 'InventoryController@inventory_out_update');
	Route::post('hide-inventory', 'InventoryController@hide_inventory');
	Route::post('inventory/search', 'InventoryController@search');
	Route::post('inventory_out/search', 'InventoryController@inv_out_search');

	Route::get('/billing/patient_balance_report/{patient_id}', 'BillingReportController@patient_balance_report');

	Route::get('/settings', 'ClientSettingController@index');
	Route::post('/client/settings/set_setting', 'ClientSettingController@set_setting');
});
