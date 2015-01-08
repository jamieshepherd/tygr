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

	Route::get('/', function()
	{
		// Testing dashboard get all information to see what's what

		$clients = Client::all();
		$users = User::all();

		return View::make('dashboard', compact('clients','users'));
	});

	Route::get('home', 'HomeController@index');

	Route::get('clients/{stub}', 'ClientController@show');

	Route::post('auth/login', 'AuthController@getLogin');
	Route::get('issues', 'IssueController@index');
	Route::get('issues/create', 'IssueController@create');
	Route::get('issues/{id}', 'IssueController@show');

	Route::get('project', 'ProjectController@index');
	Route::get('project/create', 'ProjectController@create');
});