<?php

use App\Client;
use App\User;

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

//Route::get('/', 'WelcomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::get('auth/login', 'AuthController@getLogin');
Route::get('auth/logout', 'AuthController@getLogout');

Route::group(array('middleware' => 'auth'), function() {

	/*
	Route::get('/', function()
	{
		$clients = Client::all();
		$users = User::all();

		return View::make('dashboard', compact('clients','users'));
	});
	*/

	Route::get('/', function() {
		return Redirect::to('projects');
	});

	Route::get('projects', 'ProjectController@index');

	Route::group(array('middleware' => 'admin'), function() {
		Route::get('dashboard', 'DashboardController@show');
		Route::get('clients', 'ClientController@index');
		Route::get('clients/{stub}', 'ClientController@show');
		Route::get('clients/create', 'ClientController@create');
		Route::get('clients/edit/{id}', 'ClientController@edit');
		Route::get('clients/delete/{id}', 'ClientController@delete');
	});

	Route::group(array('middleware' => 'client'), function() {
		Route::get('projects/{stub}', 'ProjectController@show');
		Route::get('projects/{stub}/issues', 'IssueController@index');
		Route::get('projects/{stub}/issues/version/{id}', 'IssueController@version');
		Route::get('projects/{stub}/issues/create', 'IssueController@create');
		Route::post('projects/{stub}/issues/create', 'IssueController@create');
		Route::get('projects/{stub}/issues/edit/{id}', 'IssueController@edit');
		Route::post('projects/{stub}/issues/edit/{id}', 'IssueController@edit');
		Route::get('projects/{stub}/issues/show/{id}', 'IssueController@show');
	});

	Route::post('auth/login', 'AuthController@getLogin');
	Route::get('issues', 'IssueController@index');
	Route::get('issues/{id}', 'IssueController@show');

	Route::get('project', 'ProjectController@index');
	Route::get('project/create', 'ProjectController@create');
});