<?php

use \App\User as User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::get('auth/login', 'AuthController@getLogin');
Route::get('auth/logout', 'AuthController@getLogout');

//> Make sure user is signed in
Route::group(array('middleware' => 'auth'), function() {

	Route::get('/', function() { return Redirect::to('projects'); });
	Route::get('projects', 'ProjectController@index');

    //>> Make sure user has at least ADMINISTRATOR priviliges
	Route::group(array('middleware' => 'admin'), function() {
		Route::get('dashboard', 'DashboardController@show');
		Route::get('clients', 'ClientController@index');
		Route::get('clients/show/{stub}', 'ClientController@show');
		Route::get('clients/create', 'ClientController@create');
		Route::post('clients/create', 'ClientController@store');
		Route::get('clients/edit/{id}', 'ClientController@edit');
		Route::post('clients/edit/{id}', 'ClientController@update');
		Route::get('clients/delete/{id}', 'ClientController@delete');
		Route::get('clients/delete/{id}/confirm', 'ClientController@destroy');
	});

    //>> Make sure user has at least CLIENT priviliges
	Route::group(array('middleware' => 'client'), function() {
		Route::get('projects/{stub}', 'ProjectController@show');
		Route::get('projects/{stub}/edit', 'ProjectController@edit');
		Route::get('projects/{stub}/issues', 'IssueController@index');
		Route::get('projects/{stub}/issues/version/{id}', 'IssueController@version');
		Route::get('projects/{stub}/issues/create', 'IssueController@create');
		Route::post('projects/{stub}/issues/create', 'IssueController@store');
		Route::get('projects/{stub}/issues/edit/{id}', 'IssueController@edit');
		Route::post('projects/{stub}/issues/edit/{id}', 'IssueController@update');
		Route::get('projects/{stub}/issues/show/{id}', 'IssueController@show');
		Route::post('projects/{stub}/issues/show/{id}', 'IssueController@updateIssueHistory');
		Route::get('projects/{stub}/issues/show/{id}/resolve', 'IssueController@resolve');
		Route::get('projects/{stub}/issues/show/{id}/reopen', 'IssueController@reopen');
		Route::get('projects/{stub}/issues/show/{id}/close', 'IssueController@close');
	});
});
