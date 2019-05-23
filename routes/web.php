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

Route::get('home', 'HomeController@index')->name('index');


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('categories', 'CategoryController');
Route::resource('outcomes', 'OutcomeController');
;
Route::get('leads/{category?}/{outcome?}', 'LeadsController@index')->name('leads');
Route::post('leadcomments/post', 'LeadsController@storeComment')->name('storeComment');