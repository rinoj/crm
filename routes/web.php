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

Route::get('leads', 'Lead\LeadController@index');
Route::post('leads', 'Lead\LeadController@store');
Route::get('leads/{id}/edit', 'Lead\LeadController@edit');

Route::get('home', 'HomeController@index')->name('index');


Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::resource('categories', 'CategoryController');