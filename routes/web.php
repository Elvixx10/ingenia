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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', ['as' => 'login', 'uses' => 'Customer\LoginController@index']);
Route::post('login', 'Customer\LoginController@setLogin');
Route::get('logout', 'Customer\LoginController@logout');

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'customer', 'namespace' => 'Customer\Dashboard'], function() {
	Route::get('/dashboard/{like?}', 'HomeController@index');
	Route::get('/edit-by-user/{id}', 'HomeController@getByUser');
	Route::get('/delete-by-user/{id}', 'HomeController@deleteByUser');
	Route::post('/update-by-user', 'HomeController@update');
	
	Route::get('/create-by-user', 'HomeController@createByUser');
	Route::post('/create', 'HomeController@create');
	Route::get('generate-pdf/{like?}','HomeController@generatePDF');
	Route::get('download-excel/{like?}', 'HomeController@downloadExcel');
});

