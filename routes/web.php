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
	if(Auth::guest() || !Auth::guest())
		return redirect()->route('login');
});

Auth::routes(['register' => false]);


//Route::resource('leads', 'Lead\LeadController');


Route::group(['middleware' => ['permission:view-crm']], function () {
	Route::get('home', 'HomeController@index')->name('index');
});

Route::group(['middleware' => ['permission:manage-users']], function () {
	Route::resource('users', 'UserController');
});

Route::group(['middleware' => ['permission:manage-roles-permissions']], function () {
	Route::resource('roles', 'RoleController');
	Route::resource('permissions', 'PermissionController');
});

Route::group(['middleware' => ['permission:manage-categories']], function () {
	Route::resource('categories', 'CategoryController');
});

Route::group(['middleware' => ['permission:manage-outcomes']], function () {
	Route::resource('outcomes', 'OutcomeController');
});

Route::group(['middleware' => ['role:admin|agent']], function () {
	Route::get('leads/{category?}/{outcome?}', 'LeadsController@index')->name('leads');
	Route::post('leadcomments/post', 'LeadsController@storeComment')->name('storeComment');
	Route::get('leadcomment/{lead_id}', 'LeadsController@getLeadComments')->name('getleadcomments');
	Route::post('leadoutcome', 'LeadsController@changeOutcome')->name('changeoutcome');

	Route::get('appointments', 'AppointmentController@index')->name('appointments');
	Route::get('appointment/{id}', 'AppointmentController@show')->name('showappointment');
});

Route::group(['middleware' => ['permission:manage-leads']], function () {
	Route::post('leadset', 'LeadsController@setLead')->name('setlead');
	Route::post('leadsset', 'LeadsController@setLeads')->name('setleads');
	Route::post('leadsetcategory', 'LeadsController@setCategory')->name('setcategory');
});


Route::group(['middleware' => ['permission:import-export-leads']], function () {
	Route::get('leadexport/{id?}/{outcome?}', 'LeadsController@export')->name('exportleads');
	Route::get('leadsimport', 'LeadsController@import')->name('import');
	Route::post('leadsimport', 'LeadsController@importStore')->name('importstore');

	Route::get('leadsimport2', 'LeadsController@import2')->name('import2');
	Route::post('leadsimport2', 'LeadsController@importStore2')->name('importstore2');
});
